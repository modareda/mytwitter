<template>
<div>
    <div class="PostBox">
        <!-- <form enctype="multipart/form-data"> -->
            <div class="form-group">
                <textarea class="myTextArea p-3 pl-4 mb-2" rows="2" v-model="post" placeholder="What's happening?"></textarea>
                <div class="d-flex justify-content-between ml-3 mr-2">
                    <div>
                        <!-- <input type="file" name="image" class="d-none"> -->
                        <i class="far fa-image fa-2x giveColour"></i>
                        <i class="far fa-smile fa-2x giveColour"></i>
                    </div>
                    <button class="btn btn-primary btn-sm myBtn" @click="addPost">Tweet</button>
                </div>
            </div>
        <!-- </form> -->
    </div>
    <div class="posts mb-2">
        <div class="card pt-2 pb-2" v-for="(post, index) in posts.data" :key='index'>
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <img src="/images/img_avatar3.png" class="img-fluid mr-2 img" alt="Cinque Terre">
                        <a :href="'/profile/'+post.user.id">{{post.user.name}} <span class="text-muted small">@{{post.user.username}}</span></a> 
                    </div>
                    <div>
                    <ul class="navbar-nav mr-3">
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" href='' class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:black"><span class="caret"></span></a>

                                <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href=''>View post</a>
                                    <a class="dropdown-item" href='' @click.prevent="deletemyPost(post.id, index)" v-if="myPost(post.user_id)">Delete</a>
                                </div>
                            </li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="card-body" v-if="post.post_id == Null">
                <p class="card-text text-break">{{post.body}}</p>
                <div class="d-flex justify-content-start" style="margin-left: -50px;">
                    <like :me='user' :post="post" :postlikes="post.likes"></like>
                    <span class="p-2 pointer" @click="sharepost(post.id)"><i class="fas fa-retweet"></i></span>
                    <comment :maincomments="post.comments" :post="post"></comment>
                </div>
            </div>
            <div class="card-body" v-else>
                <retweeted :postId='post.post_id'></retweeted>
            </div>
        </div>
    </div>

    <div class="d-block ml-5 text-center" style="cursor: pointer;">
        <p class="text-muted" @click='fetchMorePosts'  v-if="posts.next_page_url"><strong>See More</strong></p>
        <p v-else class="text-muted"><strong>No more posts :(</strong></p>
    </div>
</div>
</template>

<script>
    import like from "./child/like";
    import comment from './child/comment'
    import retweeted from './child/retweeted'
    export default {
        props:{
            postat:{},
            user:{}
        },
        data(){
            return{
                posts: this.postat,
                post:'',
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
                if(!this.post){return;}
                
                axios.post(`/home`,{body: this.post})
                .then(({data})=>{
                    this.posts = {
                        ...this.posts,
                        data:[
                            data,
                            ...this.posts.data
                        ]
                    }
                });
                this.post = '';
            },
            sharepost(postId){
                axios.post(`/home`,{body: 'Null',postid: postId})
                .then(({data})=>{
                    this.posts = {
                        ...this.posts,
                        data:[
                            data,
                            ...this.posts.data
                        ]
                    }
                });
            },
            deletemyPost(postId, index){
                if(confirm('Are you sure you wanna delete ?')){
                    axios.delete(`/home/${postId}`)
                    .then(()=>{
                        this.posts.data.splice(index, 1)
                    });
                }
            },
            myPost(postUserId){
                return this.user.id == postUserId;
            }
        },
        components:{
            like,
            comment,
            retweeted
        }
    }
</script>
