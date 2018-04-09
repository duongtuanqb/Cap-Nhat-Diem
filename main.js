(function() {
  new Vue({
    el: "#diem",
    data: {
      mssv: null,
      error: false,
      message_error: "",
      loading: false,
      name: "",
      ketqua: [],
      ok: false,
      danhsach: [],
      list: false
    },
    methods: {
      onSubmit: function() {
        this.reset();
        if (null !== this.mssv) {
            this.error = false;
            this.loading = true;
            this.$http.get("curl.php?mssv=" + this.mssv.trim())
            .then(function(res) {
                return res.json();
            })
            .then(function(res) {
              // sucess
              if(res && this.error == false) {
                var json = res;
                this.ok = true;

                this.name = json.name;

                this.ketqua.tbche4 = json.tbche4;
                this.ketqua.tbche10 = json.tbche10;
                this.ketqua.tongtinchi = json.tongtinchi;
                this.ketqua.somona = json.somona;
                this.ketqua.somonaplus = json.somonaplus;
                this.ketqua.somonb = json.somonb;
                this.ketqua.somonbplus = json.somonbplus;
                this.ketqua.somonc = json.somonc;
                this.ketqua.somoncplus = json.somoncplus;
                this.ketqua.somond = json.somond;
                this.ketqua.somondplus = json.somondplus;
                this.ketqua.somonf = json.somonf;

              } else {
                this.error = true;
                this.message_error = "Not found!";
              }
              this.loading = false;
            }, function(res) {
              // error
              this.loading = false;
              this.error = true;
              this.message_error = "Sai MSSV!";
            });
          } else {
            this.error = true;
            this.message_error = "Keyword null!";
          }
      },
      reset: function() {
        this.message_error = "";
        this.error = false;
        this.ketqua = [];
        this.loading = false;
        this.ok = false;
        this.list = false;
        this.danhsach = [];
        this.name = "";
      },
      diemToanLop: function() {
        this.ok = false;
        this.loading = true;
        this.mssv = "Đang xem điểm toàn lớp...";
        var listMSSV = [
            "14DDS0403223",
            "14DDS0403253",
            "14DDS0403213",
            "14DDS0403262",
            "14DDS0403203",
            "14DDS0403211",
            "14DDS0403221",
            "14DDS0403227",
            "14DDS0403249",
            "14DDS0403201",
            "14DDS0403214",
            "14DDS0403246",
            "14DDS0403241",
            "14DDS0403229",
            "14DDS0403212",
            "14DDS0403264",
            "14DDS0403216",
            "14DDS0403263",
            "14DDS0403234",
            "14DDS0403265",
            "14DDS0403245",
            "14DDS0403217",
            "14DDS0403242",
            "14DDS0403230",
            "14DDS0403240",
            "14DDS0403243",
            "14DDS0403228",
            "14DDS0403258",
            "14DDS0403204",
            "14DDS0403266",
            "14DDS0403235",
            "14DDS0403250",
            "14DDS0403207",
            "14DDS0403237",
            "14DDS0403244",
            "14DDS0403239",
            "14DDS0403206",
            "14DDS0403260",
            "14DDS0403219",
            "14DDS0403232",
            "14DDS0403236",
            "14DDS0403233"
          ];

        var list = [], index;
        listMSSV.map((e, i) => {
         this.$http.get("curl.php?mssv=" + e.trim())
          .then(function(res) {
              return res.json();
          })
          .then(function(res) {
            // sucess
            if(res) {
              var json = res;

               list.push({
                'mssv': e.trim(), 'name': json.name, 'tongtinchi': json.tongtinchi, 
                'tbche10': json.tbche10, 'tbche4': json.tbche4,  
                'somonaplus': json.somonaplus, 'somona': json.somona, 'somonbplus': json.somonbplus, 
                'somonb': json.somonb, 'somoncplus': json.somoncplus, 'somonc': json.somonc, 
                'somondplus': json.somondplus, 'somond': json.somond, 'somonf': json.somonf
                });

              if(i == listMSSV.length-1) {
                this.loading = false;
                this.mssv = "";
              }
            } 
          });
          
        });

        if(list) {
          this.danhsach = list;
          this.list = true;
        } else {
          this.error = true;
        }
      }
    },
    computed: {
      orderedList: function () {
        return this.danhsach.sort((a, b) => 
          a.name.slice(a.name.lastIndexOf(" ")+1, a.name.lenght).localeCompare(b.name.slice(b.name.lastIndexOf(" ")+1, b.name.lenght)));
      }
    }
  })
})();