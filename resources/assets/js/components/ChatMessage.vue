<template>

<div v-if="username === message.user.name">
    <li class="right clearfix">
        <span v-if="message.user.name === 'Admin'" class="chat-img pull-right">
            <img src="/upload_images/users/admin.png" alt="User Avatar" class="img-circle">
        </span>
        <span v-else class="chat-img pull-right">
            <img src="/upload_images/users/no-logo.png" alt="User Avatar" class="img-circle">
        </span>
        <div class="chat-body clearfix">
            <div class="header">
                <small class=" text-muted">
                    <span class="glyphicon glyphicon-time"></span>
                    <span v-if="message.message.created_at">{{ message.message.created_at }}</span>
                    <span v-else>{{message.created_at }}</span>
                </small>
                <strong class="pull-right primary-font">{{ message.user.name }}</strong>
            </div>
            <p v-if="message.message.message"><span v-html="message.message.message"></span></p>
            <p v-else><span v-html="message.message"></span></p>
        </div>
    </li>
</div>

<div v-else>
    <li class="left clearfix">
        <span v-if="message.user.name === 'Admin'" class="chat-img pull-left">
            <img src="/upload_images/users/admin.png" alt="User Avatar" class="img-circle">
        </span>
        <span v-else class="chat-img pull-left">
            <img src="/upload_images/users/no-logo.png" alt="User Avatar" class="img-circle">
        </span>
        <div class="chat-body clearfix">
            <div class="header">
                <strong class="primary-font">{{ message.user.name }}</strong>
                <small class="pull-right text-muted">
                    <span class="glyphicon glyphicon-time"></span>
                    <span v-if="message.message.created_at">{{ message.message.created_at }}</span>
                    <span v-else>{{message.created_at }}</span>
                </small>
            </div>
            <p v-if="message.message.message"><span v-html="message.message.message"></span></p>
            <p v-else><span v-html="message.message"></span></p>
        </div>
    </li>
</div>

</template>


<script>
    export default {
        props: ['message'],
        data() {
            return {
                username:$('#user-name').text()
            }
        }
    }
</script>
