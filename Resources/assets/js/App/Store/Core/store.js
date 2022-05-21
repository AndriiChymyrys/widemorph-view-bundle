const CORE = {
    namespaced: true,
    state: () => ({
        sidebarOpen: true,
        sideBarLinks: [],
    }),
    mutations: {
        OPEN_SIDEBAR: (state) => state.sidebarOpen = true,
        CLOSE_SIDEBAR: (state) => state.sidebarOpen = false,
        SET_SIDEBAR_LINK: (state, links) => state.sideBarLinks = links,
    },
    getters: {
        isSidebarOpen(state) {
            return state.sidebarOpen;
        },
        sideBarLinks(state) {
            return state.sideBarLinks;
        }
    },
    actions: {
        openSidebar({ commit }) {
            commit('OPEN_SIDEBAR')
        },
        closeSidebar({ commit }) {
            commit('CLOSE_SIDEBAR')
        },
        setSideBarLinks({ commit }, links) {
            commit('SET_SIDEBAR_LINK', links)
        }
    }
};

export default CORE;
