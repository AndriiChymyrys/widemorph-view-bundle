<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="javascript:void(0)" class="brand-link">
<!--            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"-->
<!--                 style="opacity: .8">-->
            <span class="brand-text font-weight-light">Adviser</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
<!--            <div class="user-panel mt-3 pb-3 mb-3 d-flex">-->
<!--                <div class="image">-->
<!--                    <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">-->
<!--                </div>-->
<!--                <div class="info">-->
<!--                    <a href="#" class="d-block">Alexander Pierce</a>-->
<!--                </div>-->
<!--            </div>-->

            <!-- SidebarSearch Form -->
<!--            <div class="form-inline">-->
<!--                <div class="input-group" data-widget="sidebar-search">-->
<!--                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"-->
<!--                           aria-label="Search">-->
<!--                    <div class="input-group-append">-->
<!--                        <button class="btn btn-sidebar">-->
<!--                            <i class="fas fa-search fa-fw"></i>-->
<!--                        </button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column">
                    <li class="nav-item" v-for="link in sideBarLinks" @click="handleOpenLinkClick(link)" :class="{'menu-open': link.opened}">
                        <a :href="link.href" class="nav-link" :class="{'active': link.isActive}">
                            <i class="nav-icon fas" :class="link.iconClass"></i>
                            <p>{{link.name}}<i v-if="link.children" class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul v-if="link.children" class="nav nav-treeview">
                            <li class="nav-item" v-for="child in link.children">
                                <a :href="child.href" class="nav-link" :class="{'active': child.isActive}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{child.name}}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'

export default {
    name: 'Sidebar',
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
