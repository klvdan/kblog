<template>
    <div>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ lang }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="javascript:void(0);" @click="onChangeLocale('zh')">
                    {{ zh }}
                </a>
                <a class="dropdown-item" href="javascript:void(0);" @click="onChangeLocale('en')">
                    {{ en }}
                </a>
                <a class="dropdown-item" href="javascript:void(0);" @click="onChangeLocale('ja')">
                    {{ ja }}
                </a>
            </div>
        </li>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'language',
    props: {
        langs: String
    },
    data() {
        return {
            lang: '',
            zh: '',
            en: '',
            ja: ''
        }
    },
    mounted(){
      var ls = this.langs.split(',');
      this.lang = ls[0];
      this.zh = ls[1];
      this.en = ls[2];
      this.ja = ls[3];
    },
    methods: {
        onChangeLocale(vv) {
            axios.post('/locale', {
                   'locale': vv
            }, {
                headers: {
                        // language=JQuery-CSS
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            })
            .then(function (data) {
                window.location.reload();
            }).catch(function(err) {
                console.error(err);
            });
        }
    }
}
</script>