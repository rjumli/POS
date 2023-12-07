<template>
    <Head title="Product Management" />
    <b-row>
        <b-col xl="12">
            <div class=" d-flex align-items-center">
                <h3 class="flex-grow-1 mb-n3">Products Management</h3>
                <div class="flex-shrink-0">
                    <div class="input-group mb-1">
                        <span class="input-group-text"> <i class="ri-search-line search-icon"></i></span>
                        <input type="text" v-model="keyword" placeholder="Search Name" class="form-control" style="width: 25%;">
                        <select v-model="category" @change="fetch()" class="form-select" id="inputGroupSelect02">
                            <option :value="null" selected>Select Category</option>
                            <option :value="list.id" v-for="list in categories" v-bind:key="list.id">{{list.name}}</option>
                        </select>
                        <b-button @click="openCreate()" type="button" variant="primary">
                            <i class="ri-add-circle-fill align-bottom me-1"></i> Add Product
                        </b-button>
                    </div>
                </div>
            </div>
            <hr class="text-muted"/>
        </b-col>
        <b-col xl="12">
            <div class="table-responsive">
                <table class="table table-nowrap table-bordered align-middle mb-0">
                    <thead class="bg-primary">
                        <tr class="fs-13 text-light">
                            <th style="width: 12%;" class="text-center">Code</th>
                            <th style="width: 20%;" class="text-center">Name</th>
                            <th style="width: 15%;" class="text-center">Brand</th>
                            <th style="width: 13%;" class="text-center">Category</th>
                            <th style="width: 8%;" class="text-center">Stock</th>
                            <th style="width: 8%;" class="text-center">Discount</th>
                            <th style="width: 8%;" class="text-center">Price</th>
                            <th style="width: 12%;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="fs-12" v-for="(list,index) in lists" v-bind:key="index">
                            <td class="text-center"> {{list.code}}</td>
                            <td class="text-center">
                                <h5 class="fs-12 mb-0">{{list.name}}</h5>
                            </td>
                            <td class="text-center"> {{list.brand}}</td>
                            <td class="text-center"> {{list.category.name}}</td>
                            <td class="text-center"> {{list.stock}}</td>
                            <td class="text-center"> -</td>
                            <td class="text-center"> {{formatMoney(list.price)}}</td>
                            <td class="text-center">
                                <b-button @click="openView(list)" variant="soft-primary" v-b-tooltip.hover title="View Product" size="sm" class="edit-list me-1 w-xs">View</b-button>
                                <!-- <b-button @click="edit(list)" variant="soft-primary" v-b-tooltip.hover title="Edit Product" size="sm" class="edit-list me-1 w-xs">Edit</b-button> -->
                                <b-button @click="openOrder(list)" variant="soft-primary" v-b-tooltip.hover title="View Orders" size="sm" class="edit-list me-1 w-xs">Orders</b-button>
                            
                            </td>
                        </tr>
                    </tbody>
                </table>
                <Pagination class="ms-2 me-2" v-if="meta" @fetch="fetch" :lists="lists.length" :links="links" :pagination="meta" />
            </div>
        </b-col>
    </b-row>
    <View ref="view"/>
    <Order ref="order"/>
    <Create :categories="categories" :suppliers="suppliers" :units="units" :dropdowns="dropdowns" @message="fetch()" ref="create"/>
</template>
<script>
import Order from './Order.vue';
import View from './View.vue';
import Create from './Create.vue';
import PageHeader from "@/Shared/Components/PageHeader.vue";
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { PageHeader, Pagination, Create, View, Order },
    props: ['categories','suppliers','units','dropdowns'],
    data() {
        return {
            title: "Products Management",
            items: [{text: "View",href: "/"},{ text: "Dasboard",active: true}, ],
            keyword: null,
            category: null,
            lists: [],
            meta: {},
            links: {},
        };
    },
    watch: {
        keyword(newVal){
            this.checkSearchStr(newVal);
        }
    },
    created(){
        this.fetch();
    },
    methods: {
        checkSearchStr: _.debounce(function(string) {
            this.fetch();
        }, 300),
        fetch(page_url) {
            page_url = page_url || '/products';
            axios.get(page_url, {
                params: {
                    keyword: (this.keyword) ? this.keyword : '',
                    options: 'lists',
                    category:  (this.category) ? this.category : '',
                }
            })
            .then(response => {
                this.lists = response.data.data;
                this.meta = response.data.meta;
                this.links = response.data.links;
            })
            .catch(err => console.log(err));
        },
        openCreate(){
            this.$refs.create.show();
        },
        openView(data){
            this.$refs.view.show(data);
        },  
        openOrder(data){
            this.$refs.order.show(data);
        },
        formatMoney(value) {
            let val = (value/1).toFixed(2).replace(',', '.')
            return '₱'+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
    }
}
</script>
