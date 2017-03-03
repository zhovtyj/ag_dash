<template>

<div v-if="username === message.user.name">
    <li class="right clearfix">
        <span class="chat-img pull-right">
            <img src="http://placehold.it/50/FA6F57/fff&amp;text=ME" alt="User Avatar" class="img-circle">
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
            <p v-if="message.message.message">{{ message.message.message }}</p>
            <p v-else>{{ message.message }}</p>
        </div>
    </li>
</div>

<div v-else>
    <li class="left clearfix">
        <span class="chat-img pull-left">
            <img src="http://placehold.it/50/55C1E7/fff&amp;text=U" alt="User Avatar" class="img-circle">
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
            <p v-if="message.message.message">{{ message.message.message }}</p>
            <p v-else>{{ message.message }}</p>
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
