import axios from 'axios'
import { onMounted, ref } from 'vue'

const DATA_URI = 'http://localhost/api/v1/posts'

export const fetchData = () => {
  const posts = ref([])
  const isPostsLoading = ref(true)

  const fetching = async () => {
    if (localStorage.posts) {
      console.log('from Cache')
      posts.value = JSON.parse(localStorage.getItem('posts'))
      isPostsLoading.value = false
    } else {
      setTimeout(async () => {
        console.log('from fetch')
        const { data } = await axios.get(DATA_URI)
        posts.value = data
        const stringifyPosts = JSON.stringify(posts.value)
        localStorage.setItem('posts', stringifyPosts)
        isPostsLoading.value = false
      }, 2000)
    }
  }
  onMounted(fetching)

  return {
    posts,
    isPostsLoading,
  }
}
