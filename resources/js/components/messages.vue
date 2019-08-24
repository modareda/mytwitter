<template>
    <div>
        <div class="msg_history">
            <div class="d-block ml-5 text-center" style="cursor: pointer;">
                <p class="text-muted" v-if="messages.next_page_url" @click='fetchMessages'><strong>See More</strong></p>
            </div>
            <div v-for="(message, index) in messages.data" :key='index'>

                <div class="outgoing_msg" v-if='myMessage(message.user_id)'>
                    <div class="sent_msg">
                    <p>{{message.body}}</p>
                    <span class="time_date">{{message.created_at}}</span> </div>
                </div>

                 <div class="incoming_msg" v-else>
                    <div class="incoming_msg_img"> <img src="/images/img_avatar3.png" alt="sunil"> </div>
                    <div class="received_msg">
                    <div class="received_withd_msg">
                        <p>{{message.body}}</p>
                        <span class="time_date">{{message.created_at}}</span></div>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="type_msg">
            <div class="form-group">
                <!-- input_msg_write  write_msg  -->
                <input type="text" class="form-control" placeholder="Type a message" @keyup.enter="sendMessage" v-model='newMessage'/>
                <button class="msg_send_btn" @click="sendMessage"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        user:{
            required:true
        },
        friend:{
            required:true
        }
    },
    data(){
        return {
            messages:{
                data:[]
            },
            newMessage:'',
        }
    },
    created(){
        Echo.join(`${this.friend.id}chat${this.user.id}`)
        .listen('MessageEvent', (e)=> {
            console.log(e);
            this.messages = {
                ...this.messages,
                data:[
                    ...this.messages.data,
                    e.message
                ]
            }
        })
    },
    methods:{
        fetchMessages(){
            const url = this.messages.next_page_url ? this.messages.next_page_url : `/getMessage/${this.friend.id}`;

            axios.post(url)
            .then(({data}) => {
                this.messages = {
                    ...data,
                    data:[
                        ...data.data.reverse(),
                        ...this.messages.data
                    ]
                }
            })
        },
        sendMessage(){
            axios.post(`/message/${this.friend.id}`, {
                body: this.newMessage,
                reciver: this.friend.id
            }).then(({data}) => {
                this.messages = {
                    ...this.messages,
                    data:[
                        ...this.messages.data,
                        data
                    ]
                }
                this.newMessage = ''
            })
        },
        myMessage(messageSenderId){
            if(messageSenderId == this.user.id) {return true}else {return false}
        }
    },
    mounted(){
        this.fetchMessages();
    }
}
</script>