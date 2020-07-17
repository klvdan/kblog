<template>
    <div>
        <div class="row text-white">
            <div class="col-md-4 form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" v-model="title" required aria-describedby="titleHelp"/>
                <small id="titleHelp" class="form-text text-white">Title is required!</small>
            </div>
            <div class="col-md-4 form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" v-model="category" required />
            </div>
            <div class="col-md-4 form-group">
                <label for="tag">Tag</label>
                <input type="text" class="form-control" v-model="tag" required />
            </div>
        </div>
        <mavon-editor 
            v-model="value" 
            ref="md"
            :ishljs = "true"
            style="height: 40rem"
            @imgAdd="$imgAdd"
            @imgDel="$imgDel"
        />
        <div class="row justify-content-center">
            <button type="button" class="btn btn-primary md-submit-btn" @click="submitMarkdown()">Submit</button>
        </div>
    </div>
</template>

<script>
import Vue from 'vue';
import 'mavon-editor/dist/css/index.css';
import { mavonEditor } from 'mavon-editor';

export default {
    name: 'article-editor',
    components: {
        mavonEditor
    },
    data() {
        return {
            img_file: {},
            value: '',
            title: '',
            tag: '',
            category: ''
        }
    },
    methods: {
        $imgAdd(pos,$file) {
            var formdata = new FormData();
            formdata.append('image', $file);
            axios.post(
                '/article/image/upload',
                formdata,
                {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then( res => {
                $vm.$img2Url(pos, res.data);
            })
        },
        $imgDel(pos) {
            // todo
        },
        submitMarkdown() {
            axios.post(
                '/article/add',
                {
                    title: this.title,
                    category: this.category,
                    tag: this.tag,
                    md: this.value
                },
                {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }
            ).then(res => {
                if (res.data.msg) {
                    this.notify(res.data.msg, 'error');
                } else {
                    this.notify(res.data, 'success');
                    window.location.href = '/dashboard';
                }
            })
        },
        notify(msg, type) {
            this.$notify({
            title: 'Notification',
            message: msg,
            type
            });
        }
    }
}
</script>

<style>
.md-submit-btn {
    margin-top: 0.5rem;
}
</style>