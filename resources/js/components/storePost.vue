<template>
<div>
    <div class="PostBox">
        <div class="form-group">
            <textarea class="myTextArea p-3 pl-4 mb-2" rows="2" v-model="newpost" placeholder="What's happening?"></textarea>
            <div class="d-flex justify-content-between ml-3 mr-2">
                <div>
                    <!-- <input type="file" name="image" class="d-none"> -->
                    <i class="far fa-image fa-2x giveColour"></i>
                    <i class="far fa-smile fa-2x giveColour"></i>
                </div>
                <button class="btn btn-primary btn-sm myBtn" @click="addPost">Tweet</button>
            </div>
        </div>
    </div>
    <div class="posts mb-2">
        <div class="card pt-2 pb-2" v-for="(post, index) in posts.data" :key='index'>
            <OnePost :post="post" :user="user"></OnePost>
        </div>
    </div>

    <div class="d-block ml-5 text-center" style="cursor: pointer;">
        <p class="text-muted" @click='fetchMorePosts'  v-if="posts.next_page_url"><strong>See More</strong></p>
        <p v-else class="text-muted"><strong>No more posts :(</strong></p>
    </div>
</div>
</template>

<script>
    import OnePost from './Post';

    export default {
        props:{
            postat:{},
            user:{}
        },
        data(){
            return{
                posts: this.postat,
                newpost:'',
            }
        },
        methods:{
            fetchMorePosts(){
                const url = this.posts.next_page_url ? this.posts.next_page_url: '';
                axios.get(url)
                .then(({data})=>{
                    this.posts={
                        ...data,
                        data:[
                            ...this.posts.data,
                            ...data.data,
                        ]
                    }
                });
            },
            addPost(){
                if(!this.newpost){return;}
                
                axios.post(`/home`,{body: this.newpost})
                .then(({data})=>{
                    this.pushPost(data)
                });
                this.newpost = '';
            },
            pushPost(data){
                this.posts = {
                    ...this.posts,
                    data:[
                        data,
                        ...this.posts.data
                    ]
                }
            }
        },
        components:{
            OnePost,
        },
        mounted(){
            this.$on('retweet', (data)=>{
                this.pushPost(data)
            })
        }
    }
</script>
