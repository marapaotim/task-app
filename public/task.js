$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

let id = 0;
let add = true;
let sort = 'ASC';
let sortDate = 'ASC';
const STATUS = {
    'to-do': 'Todo',
    'in-progress': 'In Progress',
    'done': 'Done'
}

$(document).ready(function(e) {
    getTasks();
    $("#form_task").submit(function(e) {
        e.preventDefault();
        if (add) {
            createTask();
        } else {
            updateTask();
        }
    });

    $('#limit').change(function() {
        getTasks();
    });

    $('#search-status').change(function() {
        getTasks();
    });

    $('#search-save-status').change(function() {
        getTasks();
    });

    $("#searchFrm").submit(function(e) {
        e.preventDefault();
        getTasks();
    });
});

function createTask() {   
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: '/create_task',
        data: {
        	title: $("#title").val(),
            content: $("#content").val(),
            status: $('#status').find('option:selected').val(),
            save_status: $('#save-status').find('option:selected').val()
        },
    }).done(function(result){
        alert(result.message);
        getTasks();
   	}).fail(function (data) {
        alert('ERROR: ' + JSON.parse(data['responseText']).message);
    }); 
}

function getTasks(page = 1) {
    var limit = $('#limit').find('option:selected').val();
    var search_status = $('#search-status').find('option:selected').val();
    var search_title = $('#title-search').val();
    var search_save_status = $('#search-save-status').find('option:selected').val();

	$.ajax({
		type: 'GET',
		url: '/get_tasks/' + limit  + '/'+ search_status +'/' + sort + '/' + sortDate + '/' + search_save_status + '/'+ search_title + '?page=' + page,
		success: function(result) { 
			var tableRow = '';
			$.each(result.data, function (key, value) { 
                data = JSON.stringify(value)
				tableRow += '<tr><td>';
				tableRow += value.id;
				tableRow += '</td><td>';
				tableRow += value.title;
				tableRow += '</td>';
                tableRow += '<td>';
				tableRow += value.content;
				tableRow += '</td>';
                tableRow += '<td>';
				tableRow += STATUS[value.status];
                tableRow += '</td>';
                tableRow += '<td>';
				tableRow += value.save_status;
                tableRow += '</td>';
                tableRow += '<td>';
				tableRow += value.created_at;
                tableRow += '</td>';
                tableRow += `<td><a href="#" onclick="retrieveData('${encodeURIComponent(JSON.stringify(value))}'); return false" class="btn btn-primary"> Edit</a> <a href="#" onclick="removeData('${value.id}'); return false" class="btn btn-danger"> Remove</a></td>`;
				tableRow += '</td><td></tr>';
   			}) 
			$("tbody#data").html(tableRow);

            var perPage = '';
            for(i = 1; i <= result.last_page; i++)
            {
                perPage += '<li class="page-item"><a class="page-link" href="#" onclick="paginate('+ i +'); return false">'+ i +'</a></li>'
            }

            $("#pagination").html(perPage);
    	}
	})
    $('#form_task')[0].reset();
    add = true;
}

function retrieveData(data) { 
	add = false;
    data = JSON.parse(decodeURIComponent(data));
    id = data.id;
    $('#title').val(data.title)
    $('#content').val(data.content)
    $('#status').val(data.status)
    $('#save-status').val(data.save_status)
}

function sortTitle()
{
    if (sort === 'DESC') {
        sort = 'ASC';
        $("#titleTable").attr('class', 'headerSortDown');
    } else {
        sort = 'DESC';
        $("#titleTable").attr('class', 'headerSortUp');
    }
    getTasks();
}

function sortDateCreated()
{
    if (sortDate === 'DESC') {
        sortDate = 'ASC';
        $("#dateCreatedTable").attr('class', 'headerSortDown');
    } else {
        sortDate = 'DESC';
        $("#dateCreatedTable").attr('class', 'headerSortUp');
    }

    getTasks();
}

function paginate(page) {
    getTasks(page);
}

function logout() {
    $.ajax({
		type: 'GET',
		url: '/logout',
		success: function(result) {
            location.href = '/';
    	}
	})
}

function updateTask() {
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: '/update_task/' + id,
        data: {
        	title: $("#title").val(),
            content: $("#content").val(),
            status: $('#status').find('option:selected').val(),
            save_status: $('#save-status').find('option:selected').val()
        },
    }).done(function(result){
        alert(result.message);
        getTasks();
   	}).fail(function (data) {
        alert('ERROR: ' + JSON.parse(data['responseText']).message);
    });
}

function removeData(id) {
    $.ajax({
        dataType: 'json',
        type:'GET',
        url: '/remove_task/' + id
    }).done(function(result) {
        alert(result.message);
        getTasks();
   	}).fail(function (data) {
        alert('ERROR: ' + JSON.parse(data['responseText']).message);
    });
}
