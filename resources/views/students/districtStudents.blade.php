@extends('home')
@section('contente')
    
@endsection



@section('scripts')
<script>
$(document).on('click', '.editBtn', function() {
    var id = $(this).val();
    console.log(id);
    $.ajax({
        type: "GET",
        url: "/edit_student/" + id,
        success: function(response) {
            console.log(response);
            $('#student_id').val(id);
            $('#name').val(response.student.name);
            $('#phone_number').val(response.student.phone_number);
            $('#dob').val(response.student.date_of_birth);
            $('#gender').val(response.student.gender);
            $('#gender').selectpicker('refresh');
            $('#center').val(response.student.center_id);
            $('#center').selectpicker('refresh');
            $('#course_id').val(response.student.course_id);
            $('#course_id').selectpicker('refresh');
        },

    });
});

$('.delBtn').on('click', function() {
    var confirmation = confirm('Are you sure you want to delete this student?');
    if (confirmation) {
        // delete it
        var student = $(this).val();
        console.log(student);

        $.ajax({
            type: 'POST',
            url: '/delete_student',
            data: {
                id: student
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    } else {
        //canceled
    }
});
</script>
@endsection