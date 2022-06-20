<template>
    <div class="card mb-2">
        <div class="card-body">
            <div class="row g-2 align-items-center">
                <div class="col-auto">
                    <span v-bind:class="`avatar avatar-lg rounded bg-${colorsList[Math.floor((Math.random()*10)+1)]}`">{{bookName[0]}}{{bookName[1]}}</span>
                </div>
                <div class="col">
                    <h4 class="card-title m-0">
                        <a href="#">{{bookName}}</a>
                    </h4>
                    <div class="text">
                        {{bookDescription}}
                    </div>


                </div>
                <div class="col-auto">
                    <a @click="()=>addExpenseModelToggle(bookId,2)" class="btn ">
                        Add Income
                    </a>
                </div>
                <div class="col-auto">
                    <a @click="()=>addExpenseModelToggle(bookId,1)" class="btn ">
                        Add Expense
                    </a>
                </div>
                 <div class="col-auto">
                    <router-link :to="{name:'expense',params:{id:bookId}}"  class="btn btn-dark">
                        View Transaction
                    </router-link>
                </div>
                <div class="col-auto">
                    <div class="dropdown">
                        <a href="#" class="btn-action" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <desc>Download more icon variants from https://tabler-icons.io/i/dots-vertical</desc>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="12" cy="19" r="1"></circle>
                                <circle cx="12" cy="5" r="1"></circle>
                            </svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <router-link :to="{name:'book',params:{id:bookId}}" class="dropdown-item">Edit</router-link>
                            <router-link :to="{name:'share-book',params:{id:bookId}}" class="dropdown-item">Share</router-link>
                            <a @click.prevent="()=>handleDeleteExpenseBook(bookId)" class="dropdown-item text-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="d-flex justify-content-end">
                   <div class="text-mute px-4">
                        <b>Owner : </b>{{bookOwner}}
                   </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    props: {
        bookId:Number,
        bookName: String,
        bookDescription: String,
        bookOwner: String,
        handleDeleteExpenseBook:Function,
        addExpenseModelToggle:Function,


    },
    setup() {
        const colorsList = ['lime', 'warning', 'primary', 'dark', 'pink', 'blue', 'indigo', 'purple', 'azure', 'red', 'orange']


        return { colorsList }
    }
};
</script>

<style>
</style>
