<template>
    <div class="article-list-table">
        <el-table
            :data="tableData.filter(data => !search || data.title.toLowerCase().includes(search.toLowerCase()))"
            style="width: 100%">
            <el-table-column
            label="Title"
            prop="title">
            </el-table-column>
            <el-table-column
            label="Author"
            prop="author">
            </el-table-column>
             <el-table-column
            label="Category">
            <template slot-scope="scope">
                <div v-for="item in scope.row.categories" v-bind:key="item.name">
                    <el-tag size="medium" type="success">{{ item.name }}</el-tag>
                </div>
            </template> 
            </el-table-column>
             <el-table-column
            label="Tag">            
            <template slot-scope="scope">
                <div v-for="item in scope.row.tags" v-bind:key="item.name">
                    <el-tag size="medium">{{ item.name }}</el-tag>
                </div>
            </template>            
            </el-table-column>
             <el-table-column
            label="Crated Date"
            sortable
            prop="created_at">
            </el-table-column>
             <el-table-column
            label="Updated Date"
            sortable
            prop="updated_at">
            </el-table-column>
            <el-table-column
            width="300px"
            align="end">
            <template slot="header" slot-scope="scope">
                <el-input
                v-model="search"
                size="mini"
                placeholder="Please enter title keyword"/>
            </template>
            <template slot-scope="scope">
                <el-button
                size="mini"
                type="primary"
                @click="onHandleDetail(scope.$index, scope.row)">Detail</el-button>
                <el-button
                size="mini"
                type="success"
                @click="onHandleEdit(scope.$index, scope.row)">Edit</el-button>
                <el-button
                size="mini"
                type="danger"
                @click="onHandleDel(scope.$index, scope.row)">Delete</el-button>
            </template>
            </el-table-column>
        </el-table>
        <div class="row align-items-center justify-content-between bg-white article-table-footer">
            <button type="button" class="btn btn-success md-submit-btn" @click="onHandleAddMarkdown"><i class="fa fa-plus-circle"></i>&nbsp;New</button>
            <el-pagination
                @size-change="onHandlePageSizeChange"
                @current-change="onHandleCurrentPageChange"
                :current-page="currentPage"
                :page-sizes="[100, 200, 300, 400]"
                :page-size="100"
                layout="total, sizes, prev, pager, next, jumper"
                :total="totalPage">
            </el-pagination>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tableData: [],
            search: '',
            currentPage: 1,
            totalPage: 0
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            let instance = this;
            axios.get('/article/list',{},{
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            }).then(function (res) {        
                instance.totalPage = res.data.length;
                instance.currentPage = 1;
                for (let it of res.data) {
                    let t = it.tags.map(i => { return {name: i.name}; });
                    let c = it.categories.map(i => { return {name: i.name}; });
                    
                    instance.tableData.push({
                        id: it.id,
                        title: it.title,
                        author: it.author,
                        tags: t,
                        categories: c,
                        created_at: new Date(it.create_at).toLocaleDateString(),
                        updated_at: new Date(it.update_at).toLocaleDateString()
                    })
                }
            });
        },
        onHandleDetail(index, row) {
            console.log(index, '  -> ', row);
        },
        onHandleEdit(index, row) {

        },
        onHandleDel(index, row) {

        },
        onHandleAddMarkdown() {
            window.location.href = '/article/new';
        },
        onHandlePageSizeChange() {

        },
        onHandleCurrentPageChange() {

        }
    }
}
</script>

<style lang="scss">
.article-list-table {
    padding: 0.3rem 0.3rem;
}
.article-table-footer {
    height: 3.5rem;
    margin-top: 0.5rem;
    margin-left: 0.1rem;
    margin-right: 0.1rem;
    padding-left: 0.3rem;
    padding-right: 0.3rem;
}
</style>