import { reactive, toRefs } from "vue";

import api from "../../config";

export default function useScheme() {
    const url = "/scheme";

    const state = reactive({
        schemes: {},
        isLoadingScheme: true,
    });

    const getSchemes = async () => {
        api.get(url).then((e) => {
            state.schemes = e.data.data;
            state.isLoadingScheme = false;
        });
    };

    const addScheme = async (data) => {
        return api.post(url, data);
    };

    return {
        ...toRefs(state),
        getSchemes,
        addScheme,
    };
}
