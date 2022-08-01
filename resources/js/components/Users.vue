<template>
  <div>
    <router-link :to="{name: 'users.create'}" class="btn btn-primary mb-3">Create user</router-link>

    <div class="card" v-if="users.length">
      <table class="table table-responsive mb-0">
        <tbody>
        <tr class="align-middle" v-for="user in users">
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.login }}</td>
          <td>{{ user.email }}</td>
          <td class="text-end">
            <router-link :to="{name: 'users.edit', params: {id: user.id}}" class="btn btn-info btn-sm">Edit user</router-link>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
    name: "Users",
    data(){
        return {
            users: [],
        }
    },
    mounted(){
        this.getUsers()
    },
    methods: {
        getUsers: function (){
            axios.get('users').then(response => {
                this.users = response.data.data
            }).catch(error => {
                this.$toast.danger(error.response.data.message)
            })
        }
    },
}
</script>

<style scoped>
tbody tr:last-child td{
    border-bottom-width: 0;
}
</style>
