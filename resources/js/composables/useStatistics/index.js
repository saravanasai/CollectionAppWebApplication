import { reactive, toRefs } from "vue";

import api from "../../config";

export default function useStatistics() {
    const staticsPlanUrl = "/statistics/plan";
    const staticsAgentUrl = "/statistics/agent";
    const staticsLocationUrl = "/statistics/location";
    const staticsDashboardUrl = "/statistics/dashboard";

    const state = reactive({
        planStatistics: {},
        isLoadingPlanStatistics: true,
        agentStatistics: {},
        isLoadingAgentStatistics: true,
        locationStatistics: {},
        isLoadingLocationStatistics: true,
        dashboardStatistics: {},
        isLoadingDashboardStatistics: true,
    });

    const getPlanStatics = async () => {
        api.get(staticsPlanUrl).then((e) => {
            state.planStatistics = e.data.data;
            state.isLoadingPlanStatistics = false;
        });
    };

    const getAgentStatics = async () => {
        api.get(staticsAgentUrl).then((e) => {
            state.agentStatistics = e.data.data;
            state.isLoadingAgentStatistics = false;
        });
    };

    const getLocationStatics = async () => {
        api.get(staticsLocationUrl).then((e) => {
            state.locationStatistics = e.data.data;
            state.isLoadingLocationStatistics = false;
        });
    };


    const getDashboardStatics = async () => {
        api.get(staticsDashboardUrl).then((e) => {
            state.dashboardStatistics = e.data.data;
            state.isLoadingDashboardStatistics = false;
        });
    };

    return {
        ...toRefs(state),
        getPlanStatics,
        getLocationStatics,
        getDashboardStatics,
        getAgentStatics
    };
}
