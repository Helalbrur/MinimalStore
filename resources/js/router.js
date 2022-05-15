import Vue from 'vue';
import VueRouter from 'vue-router'
Vue.use(VueRouter)

// item route
let itemList = require('./pages/item/index.vue').default;
let itemEdit = require('./pages/item/edit.vue').default;
let itemCreate = require('./pages/item/create.vue').default;


// Supplier route
let supplierList = require('./pages/supplier/index.vue').default;
let supplierEdit = require('./pages/supplier/edit.vue').default;
let supplierCreate = require('./pages/supplier/create.vue').default;

// Receive route
let receiveList = require('./pages/receive/index.vue').default;
let receiveEdit = require('./pages/receive/edit.vue').default;
let receiveCreate = require('./pages/receive/create.vue').default;

// Requisition route
let requisitionList = require('./pages/requisition/index.vue').default;
let requisitionEdit = require('./pages/requisition/edit.vue').default;
let requisitionCreate = require('./pages/requisition/create.vue').default;

// Requisition route
let issueList = require('./pages/issue/index.vue').default;
let issueEdit = require('./pages/issue/edit.vue').default;
let issueCreate = require('./pages/issue/create.vue').default;

// Stock route
let stock = require('./pages/stock/index.vue').default;

// home route
let home = require('./pages/home.vue').default;

// Authentication File
let login= require('./pages/auth/login.vue').default;
let logout = require('./pages/auth/logout.vue').default;

const routes =new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes : [
        { 
            path: '/',
            component: home,
            name:'home' 
        },
        { 
            path: '/item-list',
            component: itemList,
            name:'item-list' 
        },
        { 
            path: '/item-edit/',
            component: itemEdit,
            name:'item-edit' ,
            props: true
        },
        { 
            path: '/item-create/',
            component: itemCreate,
            name:'item-create'
        },
        { 
            path: '/supplier-list',
            component: supplierList,
            name:'supplier-list' 
        },
        { 
            path: '/supplier-edit/',
            component: supplierEdit,
            name:'supplier-edit' ,
            props: true
        },
        { 
            path: '/supplier-create/',
            component: supplierCreate,
            name:'supplier-create'
        },
        { 
            path: '/receive-list',
            component: receiveList,
            name:'receive-list' 
        },
        { 
            path: '/receive-edit/',
            component: receiveEdit,
            name:'receive-edit' ,
            props: true
        },
        { 
            path: '/receive-create/',
            component: receiveCreate,
            name:'receive-create'
        },
        { 
            path: '/requisition-list',
            component: requisitionList,
            name:'requisition-list' 
        },
        { 
            path: '/requisition-edit/',
            component: requisitionEdit,
            name:'requisition-edit' ,
            props: true
        },
        { 
            path: '/requisition-create/',
            component: requisitionCreate,
            name:'requisition-create'
        },
        { 
            path: '/issue-list',
            component: issueList,
            name:'issue-list' 
        },
        { 
            path: '/issue-edit/',
            component: issueEdit,
            name:'issue-edit' ,
            props: true
        },
        { 
            path: '/issue-create/',
            component: issueCreate,
            name:'issue-create'
        },
        { 
            path: '/login',
            component: login,
            name:'login' 
        },
        { 
            path: '/logout',
            component: logout,
            name:'logout' 
        }
        ,
        { 
            path: '/stock',
            component: stock,
            name:'stock' 
        }
    ]
});
export default routes;
