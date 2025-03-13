import { defineStore } from 'pinia'
import axios from 'axios'

export const useAuthStore = defineStore('authStore', {
  state: () => ({ user: null, errors: {} }),
  getters: {},
  actions: {
    // GETUSER

    getAuthUser() {
      if (localStorage.getItem('token')) {
        axios({
          method: 'get',
          url: `http://localhost/api/v1/users`,
          headers: {
            authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        })
          .then((response) => {
            this.user = response.data
          })
          .catch((e) => {
            console.log(e)
          })
      }
    },

    // LOGOUT

    async logout() {
      const res = await fetch(`http://localhost/api/v1/logout`, {
        method: 'post',
        headers: {
          authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })
      const data = await res.json()
      console.log(data)

      if (data.message) {
        this.user = null
        this.errors = {}
        localStorage.removeItem('token')
        this.router.push({ name: 'login' })
      }
    },

    //  AUTH

    loginAuth(apiRoute, formData) {
      axios({
        method: 'POST',
        url: `http://localhost/api/v1/${apiRoute}`,
        data: {
          name: formData.name,
          password: formData.password,
          password_confirmation: formData.password_confirmation,
          email: formData.email,
          nickname: formData.nickname,
        },
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/json',
        },
      })
        .then((response) => {
          localStorage.setItem('token', response.data.token)
          this.user = response.data.user
          this.router.push({ name: 'main' })
        })
        .catch((error) => {
          if (error.response && error.response.status === 403) {
            console.error('Доступ запрещен из-за CORS')
          } else {
            this.errors = error.response.data.errors
          }
        })
    },
  },
})
