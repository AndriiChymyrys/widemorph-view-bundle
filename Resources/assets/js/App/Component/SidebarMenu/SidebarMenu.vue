<template>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column">
            <li class="nav-item" v-for="link in sideBarLinks" @click="handleOpenLinkClick(link)"
                :class="{'menu-open': link.opened}">
                <a :href="link.route" class="nav-link" :class="{'active': link.isActive}">
                    <i class="nav-icon fas fa-bars"></i>
                    <p>{{ link.label }}<i v-if="link.children" class="right fas fa-angle-left"></i></p>
                </a>
                <ul v-if="link.children" class="nav nav-treeview">
                    <li class="nav-item" v-for="child in link.children">
                        <a :href="child.route" class="nav-link" :class="{'active': child.isActive}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ child.label }}</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</template>

<script>
import {mapActions, mapGetters} from 'vuex'

export default {
    name: 'SidebarMenu',
    props: ['links'],
    mounted() {
        this.handleSetSideBarLinks(this.links)
    },
    methods: {
        handleOpenLinkClick(link) {
            if (!link.children) return;

            link.opened = !link.opened;
        },
        handleSetSideBarLinks(links) {
            for (let link of links) {
                if (link.children) {
                    link.opened = link.isActive;
                }
            }

            this.setSideBarLinks(links)
        },
        ...mapActions('core', ['setSideBarLinks'])
    },
    computed: {
        ...mapGetters('core', ['sideBarLinks'])
    }
}
</script>
