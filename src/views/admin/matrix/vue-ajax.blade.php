$.ajax({
    url: "{{ url('admin/matrix/add_matrix_block') }}",
    type: 'post',
    async: false, /*must use async false to get data back*/
    context: this, /*IMPORTANT to update vue dom*/
    data: {
        matrix:this.matrixContent,
        items: JSON.stringify({
            fieldname: this.fieldname,
            instructions: this.instructions,
            length: this.fieldlength,
            type: this.crselect,
            filetype: this.filetype,
            variations: this.variations,
        }),
        "_token": "{{ csrf_token() }}"
    },
    dataType: 'json', /*must use json to identify err msg a,b */
    success: function (data) {
        //alert(data);
        if (data.a == "success") {
            this.fielderrors = '';
            this.csverrors = '';

            if (this.crselect == 'plain-text') {
                this.matrixContent.push({
                    'type': 'plain-text',
                    'title': this.fieldname,
                    'instructions': this.instructions,
                    'errors': '',
                    'length': this.fieldlength,
                    'variations': '',
                    'content': ''
                });
            }
            if (this.crselect == 'multi-line') {
                this.matrixContent.push({
                    'type': 'multi-line',
                    'title': this.fieldname,
                    'instructions': this.instructions,
                    'errors': '',
                    'length': '',
                    'variations': '',
                    'content': ''
                });
            }
            if (this.crselect == 'rich-text') {
                this.matrixContent.push({
                    'type': 'rich-text',
                    'title': this.fieldname,
                    'instructions': this.instructions,
                    'errors': '',
                    'length': '',
                    'variations': '',
                    'content': ''
                });
            }
            if (this.crselect == 'drop-down') {

                var array = this.variations.split(',');
                //var string = JSON.stringify(array);
                this.matrixContent.push({
                    'type': 'drop-down',
                    'title': this.fieldname,
                    'instructions': this.instructions,
                    'errors': '',
                    'length': '',
                    'variations': array,
                    'content': ''
                });
            }
            if (this.crselect == 'check-box') {
                var array = this.variations.split(',');
                //var string = JSON.stringify(array);
                this.matrixContent.push({
                    'type': 'check-box',
                    'title': this.fieldname,
                    'instructions': this.instructions,
                    'errors': '',
                    'length': '',
                    'variations': array,
                    'checkedValues': ['default'],
                    'content': ''
                });
            }
            if (this.crselect == 'color') {
                this.matrixContent.push({
                    'type': 'color',
                    'title': this.fieldname,
                    'instructions': this.instructions,
                    'errors': '',
                    'length': '',
                    'variations': '',
                    'content': ''
                });
            }
            if (this.crselect == 'file-upload') {
                var array = this.filetype.split('|');
                this.matrixContent.push({
                    'type': 'file-upload',
                    'title': this.fieldname,
                    'instructions': this.instructions,
                    'errors': '',
                    'length': '',
                    'variations': array,
                    'showAssets': false,
                    'content': '',
                    'thumb': ''
                });
            }
            if (this.crselect == 'number') {
                this.matrixContent.push({
                    'type': 'number',
                    'title': this.fieldname,
                    'instructions': this.instructions,
                    'errors': '',
                    'length': this.fieldlength,
                    'variations': '',
                    'content': ''
                });
            }
            if (this.crselect == 'date') {
                this.matrixContent.push({
                    'type': 'date',
                    'title': this.fieldname,
                    'instructions': this.instructions,
                    'errors': '',
                    'length': '',
                    'variations': '',
                    'content': ''
                });
            }
            if (this.crselect == 'switch') {
                this.matrixContent.push({
                    'type': 'switch',
                    'title': this.fieldname,
                    'instructions': this.instructions,
                    'errors': '',
                    'length': '',
                    'variations': '',
                    'content': ''
                });
            }

            /*clear text box*/
            this.fieldname = "";
            this.instructions = "";

        } else {
            //alert('error');
            this.$refs.toast.showToast(4000);

            this.fielderrors = data.a;
            this.csverrors = data.b;
        }
    }
});
