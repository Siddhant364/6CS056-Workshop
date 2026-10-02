<!DOCTYPE html>
<html>

<head>
    <title>Course Details</title>
</head>

<body>

<h1>Course Details</h1>


<p>
    <strong>ID:</strong>
    {{ $course->id }}
</p>


<p>
    <strong>Course Name:</strong>
    {{ $course->name }}
</p>


<p>
    <strong>Course Code:</strong>
    {{ $course->code }}
</p>


<p>
    <strong>Description:</strong>
    {{ $course->description }}
</p>


<p>
    <strong>Credits:</strong>
    {{ $course->credits }}
</p>


<br>


<a href="/courses/{{ $course->id }}/edit">
    Edit Course
</a>


<br>
<br>


<a href="/courses">
    Back to Courses
</a>

</body>

</html>