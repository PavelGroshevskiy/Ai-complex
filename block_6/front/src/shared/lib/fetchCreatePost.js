import axios from 'axios'
import { onMounted, ref } from 'vue'

const DATA_URI = 'http://localhost/api/v1/user/posts'

export const fetchCreatePost = (title, description) => {
  const error = ref('')
  const response = ref('')

  const postRequestPost = async () => {
    axios({
      method: 'post',
      url: DATA_URI,
      data: {
        title: title,
        description: description,
      },
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        'Access-Control-Allow-Origin': 'http://localhost:5173',
      },
    })
      .then(function (response) {
        console.log(response.data)
        response.value = response.data
      })
      .catch((error) => {
        if (error.response && error.response.status === 403) {
          error.value = error.response
          console.error('Доступ запрещен из-за CORS')
        } else if (error.response && error.response.status === 422) {
          error.value = error.response

          console.error('Ошибки валидации:', error.response.data.errors)
        } else {
          error.value = error.response

          console.error('Произошла ошибка:', error)
        }
      })
  }
  onMounted(postRequestPost)

  return {
    response,
    error,
  }
}
