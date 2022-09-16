<template>
    <div class="container">
        <h1>Contattaci</h1>

        <form>
            <div class="mb-3">
                <label for="user-name" class="form-label">Nome</label>
                <input v-model="userName" type="text" class="form-control" id="user-name">
            </div>
            <div class="mb-3">
                <label for="user-mail" class="form-label">Mail</label>
                <input v-model="userMail" type="email" class="form-control" id="user-mail">
            </div>
            <div class="mb-3">
                <label for="user-message" class="form-label">Messaggio</label>
                <textarea v-model="userMessage" class="form-control" id="user-message" rows="5"></textarea>
            </div>

            <input type="submit" class="btn btn-primary">
        </form>
        
    </div>
</template>

<script>
export default {
    name: 'ContactPage',
    data() {
        return {
            userName: '',
            userMail: '',
            userMessage: ''
        }
    }
}
</script>