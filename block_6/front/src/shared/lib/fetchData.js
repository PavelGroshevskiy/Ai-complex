import axios from 'axios'
import { onMounted, ref } from 'vue'

const DATA_URI = 'http://localhost/api/v1/user/posts'

export const fetchData = () => {
  const posts = ref([])
  const error = ref('')
  const isPostsLoading = ref(true)

  const fetching = async () => {
    if (localStorage.posts) {
      console.log('from Cache')
      posts.value = JSON.parse(localStorage.getItem('posts'))
      isPostsLoading.value = false
    } else {
      setTimeout(async () => {
        try {
          console.log('from fetch')
          const { data } = await axios.get(DATA_URI, {
            headers: {
              'Access-Control-Allow-Origin': '*',
            },
          })
          console.log(data)
          posts.value = data
          const stringifyPosts = JSON.stringify(posts.value)
          // localStorage.setItem('posts', stringifyPosts)
          isPostsLoading.value = false
        } catch (e) {
          error.value = e.message
        }
      }, 2000)
    }
  }
  onMounted(fetching)

  return {
    posts,
    isPostsLoading,
    error,
  }
}
