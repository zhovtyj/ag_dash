<template lang="html">

    <ul class="chat">

        <chat-message v-for="message in messages" :message="message"></chat-message>
        <li class="empty" v-show="messages.length == 0">
            Nothing here yet!
        </li>



    </ul>

</template>

<script>
export default {
    props: ['messages']
}
</script>