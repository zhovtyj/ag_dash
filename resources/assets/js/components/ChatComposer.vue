<template lang="html">

    <div class="chat-composer input-group">
        <input id="message" type="text" class="form-control input-sm" v-model="messageText" @keyup.enter="sendMessage" placeholder="Type your message here..." />
        <span class="input-group-btn">
            <button class="btn btn-warning btn-sm" id="btn-chat" @click="sendMessage">Send</button>
        </span>
    </div>


</template>


<script>
export default {
    data() {
        return {
            messageText: ''
        }
    },
    methods: {
        sendMessage() {
            this.$emit('messagesent', {
                message: this.messageText,
                user: {
                    name:$('#user-name').text()
                }
            });
            this.messageText = '';
        }
    }
}
</script>
