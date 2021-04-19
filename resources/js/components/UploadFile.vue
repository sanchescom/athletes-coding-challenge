<template>
    <div>
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Upload</h1>
        </div>
        <div v-if="currentFile" class="progress">
            <div
                class="progress-bar progress-bar-info progress-bar-striped"
                role="progressbar"
                :aria-valuenow="progress"
                aria-valuemin="0"
                aria-valuemax="100"
                :style="{ width: progress + '%' }"
            >
                {{ progress }}%
            </div>
        </div>
        <div class="alert alert-light" role="alert">{{ message }}</div>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="file" ref="file" v-on:change="upload()">
            <label class="custom-file-label" for="file">Choose file</label>
        </div>
    </div>
</template>

<script>
import UploadService from "../services/UploadFilesService";

export default {
    data() {
        return {
            selectedFiles: undefined,
            currentFile: undefined,
            progress: 0,
            message: "",
            fileInfos: []
        };
    },
    methods: {
        upload() {
            this.selectedFiles = this.$refs.file.files;
            this.progress = 0;
            this.currentFile = this.selectedFiles.item(0);
            UploadService.upload(this.currentFile, event => {
                this.progress = Math.round((100 * event.loaded) / event.total);
            })
                .then(response => {
                    this.message = response.data.message;
                    this.$router.push({name: 'listAthletes'})
                })
                .then(files => {
                    this.fileInfos = files.data;
                })
                .catch(() => {
                    this.progress = 0;
                    this.message = "Could not upload the file!";
                    this.currentFile = undefined;
                });
            this.selectedFiles = undefined;
        },
    },
};
</script>
