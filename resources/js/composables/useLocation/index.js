import { reactive, toRefs } from "vue";

import api from "../../config";

export default function useLocation() {
    const url = "/location";

    const state = reactive({
        locations: {},
        location: {},
        isLoadingLocation: true,
    });

    const getLocations = async () => {
        api.get(url).then((e) => {
            state.locations = e.data.data;
            state.isLoadingLocation = false;
        });
    };

    const addLocation = (data) => {
        return api.post(url, data);
    };

    const getLocation = async (id) => {
        api.get(url + "/" + id).then((e) => {
            state.location = e.data.data;
            state.isLoadingLocation = false;
        });
    };

    const updateLocation = async (id) => {
        let data = {
            location_name: state.location.locationName,
        };

        return api.put(url + "/" + id, data);
    };

    return {
        ...toRefs(state),
        getLocations,
        getLocation,
        updateLocation,
        addLocation,
    };
}
