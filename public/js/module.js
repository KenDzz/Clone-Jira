
var pusher = new Pusher("237126178564118da15e", {
    cluster: "ap1",
    encrypted: true,
    auth: {
        headers: {
            Authorization: 'Bearer ' + localStorage.getItem("token")
        },
    },
    authEndpoint: '/broadcasting/auth'
});

var channel = pusher.subscribe("private-user."+localStorage.getItem("id"));


channel.bind("App\\Events\\NewTaskEvent", (data) => {
    console.log(data);
    Swal.fire({
        icon: "warning",
        title: "Tin Zui! Tin Zui nè ^_^",
        text: "Bạn vừa được nhận một nhiệm vụ mới có tên là: "+data.task.name+" thuộc dự án ("+data.task.project.name+")",
        footer: '<a href="/task/info/'+data.task.id+'">Click vào đây để xem chi tiết nhiệm vụ </a>'
      });
});

