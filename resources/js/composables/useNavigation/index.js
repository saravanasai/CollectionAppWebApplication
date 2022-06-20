import { useRoute, useRouter } from "vue-router"

export default function useNavigation()
{

    const router = useRouter()
    const route = useRoute()

    return {router,route}
}
