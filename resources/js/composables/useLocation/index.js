import { reactive, toRefs } from "vue";

import api from "../../config"

export default function useLocation() {
    const url = "/location";

    const state = reactive({
        locations: {},
        isLoadingLocation: true,
    });

    const getLocations = async () => {
        api.get(url).then((e) => {
            state.locations = e.data.data;
            state.isLoadingLocation = false;

        });
    };

    const addLocation = (data)=>{

        return api.post(url,data)
    }

    return {
        ...toRefs(state),
        getLocations,
        addLocation
    };
}