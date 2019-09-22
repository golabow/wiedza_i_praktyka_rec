<script>
    export default {
        data: function () {
            return {
                api_config: {
                    use_global_loader: false,
                    api_dictionaries: {},
                },
                api_loading: false,
            };
        },
        methods: {
            show_global_loader: function() {
                this.$root.$refs.loader.show();
            },
            hide_global_loader: function() {
                this.$root.$refs.loader.hide();
            },
            get: async function (url, data, config) {
                return await this.ajax(
                  url,
                  'GET',
                  data,
                  Object.assign({}, this.api_config, config)
                );
            },
            put: async function (url, data, config) {
                return await this.ajax(
                    url,
                    'PUT',
                    data,
                    Object.assign({}, this.api_config, config)
                );
            },
            post: async function (url, data, config) {
                return await this.ajax(
                    url,
                    'POST',
                    data,
                    Object.assign({}, this.api_config, config)
                );
            },
            delete: async function (url, data, config) {
                return await this.ajax(
                    url,
                    'DELETE',
                    data,
                    Object.assign({}, this.api_config, config)
                );
            },
            ajax: async function (url, type, data, config) {
                if (config.use_global_loader === true) {
                    this.show_global_loader();
                }

                this.api_loading = true;

                let ajax_config = Object.assign({}, {type: type, data: data}, config);

                var response = await $.ajax(
                    url,
                    ajax_config
                );

                if (config.use_global_loader === true) {
                    this.hide_global_loader();
                }

                this.api_loading = false;

                return response;
            }
        }
    }
</script>