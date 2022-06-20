<template>
    <div class="card mb-2 shadow-lg p-3 mb-3 bg-body rounded" style="max-width: 100%;">
        <div class="row g-0">
            <div class="col-md-2">
                <!-- <img src="./" class="img-fluid rounded-start" alt="..."> -->
            </div>
            <div class="col-md-10">
                <div class="card-body">
                    <h5 class="card-title">
                        <h2 v-bind:class="(expenseType != '1') ? 'text-success' : 'text-danger'">$-{{ amount }}</h2>
                    </h5>
                    <h5>
                        <span class="badge" v-bind:class="(expenseType != '1') ? 'bg-success-lt' : 'bg-danger-lt'">{{
                                category
                        }}</span>
                    </h5>
                    <p class="card-text">{{ note }}</p>
                    <div class="d-flex justify-content-end">
                        <div>
                            <template v-if="expenseType == '1'">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-up"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <desc>Download more icon variants from https://tabler-icons.io/i/arrow-up</desc>
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="18" y1="11" x2="12" y2="5"></line>
                                    <line x1="6" y1="11" x2="12" y2="5"></line>
                                </svg>
                            </template>
                            <template v-else>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-arrow-narrow-down" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <desc>Download more icon variants from https://tabler-icons.io/i/arrow-narrow-down
                                    </desc>
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="16" y1="15" x2="12" y2="19"></line>
                                    <line x1="8" y1="15" x2="12" y2="19"></line>
                                </svg>
                            </template>
                        </div>
                        <div class="d-flex flex-column">
                        <p class="card-text"><small class="text-muted">{{ created }}</small></p>
                        <p class="card-text"><small class="text-muted">{{ expenseUser.name }}</small></p>
                        <p class="card-text"><small class="text-muted">{{ expenseUser.email }}</small></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row mt-2">
                        <div class="d-flex justify-content-end" v-if="expenseUser.user_id==12">
                            <a @click="()=>handleDeleteExpense(expenseId)" class="btn btn-danger btn-pill">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <desc>Download more icon variants from https://tabler-icons.io/i/trash</desc>
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="4" y1="7" x2="20" y2="7"></line>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                </svg> Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        expenseId: Number,
        amount: Number,
        expenseType: String,
        expenseUser: Object,
        note: String,
        category: String,
        created: String,
        handleDeleteExpense:Function
    },
    setup(props) { },
};
</script>

<style>
</style>
