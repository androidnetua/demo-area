<template>
<div class="row">
    <div class="col-auto">
        <h6 class="mb-4" v-if="!id">Creating new device</h6>
        <h6 class="mb-4" v-if="id">Editing {{ vendorName }} {{ name }}</h6>
        <div class="row mb-2">
            <div class="col">
                <label for="vendor_id" class="col-form-label">Vendor</label>
            </div>
            <div class="col-auto">
                <select class="form-select" id="vendor_id" v-model="vendor_id">
                    <option selected></option>
                    <option v-for="vendor in vendors" :value="vendor.id">{{ vendor.name }}</option>
                </select>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col">
                <label for="name" class="col-form-label">Name</label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" id="name" v-model="name" @keyup="generateSlug">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col">
                <label for="slug" class="col-form-label">Slug</label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" id="slug" v-model="slug">
            </div>
        </div>

        <div class="row mb-2" v-for="param in params">
            <div class="col">
                <label :for="param.param" class="col-form-label">{{ param.name }}</label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" :id="param.param" v-model="param.value">
            </div>
        </div>
    </div>
    <div class="col-auto ms-3">
        <div class="mb-3 d-flex justify-content-between specs-buttons">
            <button class="btn btn-primary px-3" v-if="!id" @click="create">Create</button>
            <button class="btn btn-primary px-3" v-if="id" @click="update">Update</button>
            <button class="btn btn-outline-secondary ms-3" v-if="id" @click="copy">Copy</button>
            <button class="btn btn-outline-secondary ms-3" @click="clear">Clear</button>
        </div>
        <specs-list :type="type" @load="load" ref="specs_list"></specs-list>
    </div>
</div>
</template>

<script>
import slugify from "slugify";
import SpecsList from "./SpecsList";
export default {
    name: "SpecsForm",
    components: {SpecsList},
    props: [
        'type',
    ],
    data(){
        return {
            vendors: [],
            id: null,
            vendor_id: null,
            name: null,
            slug: null,
            params: [],
        }
    },
    methods: {
        getVendors(){
            axios.get('specs/vendors').then((response) => {
                this.vendors = response.data.data
            })
        },
        getParams() {
            axios.get(`specs/${this.type}/params`).then((response) => {
                for (const [key, value] of Object.entries(response.data.data)) {
                    this.params.push({
                        param: key,
                        name: value,
                        value: null,
                    });
                }
            })
        },
        generateSlug(){
            this.slug = slugify(this.name, {lower: true})
        },
        load(id){
            axios.get(`specs/${this.type}/${id}`).then(response => {
                this.insertData(response.data)
            }).catch(error => {
                this.$toast.danger(error.response.data.message)
            })
        },
        insertData(data){
            this.id = data.id
            this.vendor_id = data.vendor_id
            this.name = data.name
            this.slug = data.slug
            for(const el of Object.values(this.params)){
                el.value = data.data[el.param]
            }
        },
        getData(){
            const params = {}
            this.params.forEach((el) => {
                params[el.param] = el.value
            })
            return {
                id: this.id,
                vendor_id: this.vendor_id,
                name: this.name,
                slug: this.slug,
                data: params,
            }
        },
        create() {
            axios.post(`specs/${this.type}`, this.getData()).then(response => {
                this.$toast.success(response.data.message)
                this.$refs.specs_list.getList()
            }).catch(error => {
                this.$toast.danger(error.response.data.message)
            })
        },
        update() {
            axios.put(`specs/${this.type}/${this.id}`, this.getData()).then(response => {
                this.$toast.success(response.data.message)
                this.$refs.specs_list.getList()
            }).catch(error => {
                this.$toast.danger(error.response.data.message)
            })
        },
        copy(){
            this.id = null
        },
        clear(){
            this.id = this.vendor_id = this.name = this.slug = null
            this.params.forEach(el => {
                el.value = null
            })
        },
    },
    computed: {
        vendorName: function () {
            let vendorName
            this.vendors.forEach(vendor => {
                if (vendor.id === this.vendor_id)
                    vendorName = vendor.name
            })
            return vendorName
        },
    },
    mounted() {
        this.getVendors()
        this.getParams()
    },
}
</script>

<style scoped>
.specs-buttons{
    width: 200px;
}
h6 {
    font-weight: bold;
}
</style>
