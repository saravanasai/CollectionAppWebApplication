import { reactive, toRefs } from "vue"

export default function store(){



    const store = reactive({
        authToken:"sdfasdfasd",
        authState:false,
    })

    function updateAuthState(authentication_status)
    {
        store.authState=authentication_status

    }

    return {...toRefs(store),updateAuthState}


}
