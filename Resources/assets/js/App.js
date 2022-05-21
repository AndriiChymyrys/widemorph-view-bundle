import { createApp } from 'vue/dist/vue.esm-bundler';
import { mapGetters } from "vuex";
import { registerComponents } from './utils/component-utils';

// Import modules component
import CoreComponents from './App/Component/components';
// import {GAMES_CRAWLER_COMPONENTS} from "../../../../GamesCrawler/Resources/assets/js/gamesCrawlerApp";

// Import modules store
import Store from './Store';

const app = createApp({
    watch: {
        isSidebarOpen: (newValue) => {
            newValue ? document.getElementsByTagName('body')[0].classList.remove('sidebar-collapse') :
                document.getElementsByTagName('body')[0].classList.add('sidebar-collapse');
        }
    },
    computed: {
        ...mapGetters('core', ['isSidebarOpen']),
    }
})

registerComponents(app, CoreComponents)
// registerComponents(app, GAMES_CRAWLER_COMPONENTS)

app.use(Store);

app.mount('#app');
