
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('chat-message', require('./components/ChatMessage.vue'));
Vue.component('chat-log', require('./components/ChatLog.vue'));
Vue.component('chat-composer', require('./components/ChatComposer.vue'));

console.log(window.agency_id);

const app = new Vue({
    el: '#admin-chat',
    data: {
        messages: [],
        usersInRoom: []
    },
    methods: {
        addMessage(message) {
            // Add to existing messages
            //this.messages.push(message);
            // Persist to the database etc
            axios.post('/admin/messages/'+agency_id, message).then(response => {
                // Do whatever;
            })
        }
    },
    created(){
        axios.get('/admin/messages/'+agency_id+'/all').then(response => {
            this.messages = response.data;
        });

        Echo.join('chatroom'+agency_id)
            .here((users) => {
                this.usersInRoom = users;
            })
            .joining((user) => {
                this.usersInRoom.push(user);
            })
            .leaving((user) => {
                this.usersInRoom = this.usersInRoom.filter(u => u != user)
            })
            .listen('MessagePosted', (e) => {
                this.messages.push({
                    message: e.message,
                    user: e.user
                });
            });
    }
});
