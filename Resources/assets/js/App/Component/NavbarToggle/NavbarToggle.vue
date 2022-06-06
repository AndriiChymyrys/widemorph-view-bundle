<template>
    <li class="nav-item">
        <a class="nav-link"
           href="javascript:void(0);"
           @click="toggleSidebar()"
           role="button">
            <i class="fas fa-bars"></i>
        </a>
    </li>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'

export default {
    name: 'NavbarToggle',
    methods: {
        toggleSidebar() {
            this.isSidebarOpen ? this.closeSidebar() : this.openSidebar();
        },
        ...mapActions('core', ['openSidebar', 'closeSidebar']),
    },
    computed: {
        ...mapGetters('core', ['isSidebarOpen']),
    }
}
</script>
