<?php


/* ------------------------------------------------------------------ */
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home');
});


/* ------------------------------------------------------------------ */
// Administration
Breadcrumbs::for('admin', function ($trail) {
    $trail->push('Administration');
});

// Administration > Users
Breadcrumbs::for('admin.users', function ($trail) {
    $trail->parent('admin');
    $trail->push('Users', route('admin.users'));
});

// Administration > Users > Create User
Breadcrumbs::for('admin.users.create', function ($trail) {
    $trail->parent('admin.users');
    $trail->push('Create User', route('admin.users.create'));
});

// Administration > Users > Edit User
Breadcrumbs::for('admin.users.edit', function ($trail, $user) {
    $trail->parent('admin.users');
    $trail->push($user->full_name.': Edit', route('admin.users.edit', $user->id));
});

// Administration > Interviews
Breadcrumbs::for('admin.interviews', function ($trail) {
    $trail->parent('admin');
    $trail->push('Interviews', route('admin.interviews'));
});

// Administration > Interview Types
Breadcrumbs::for('admin.interview_types', function ($trail) {
    $trail->parent('admin');
    $trail->push('Interview Types', route('admin.interview_types'));
});

// Administration > Interview Types > Create Interview Type
Breadcrumbs::for('admin.interview_types.create', function ($trail) {
    $trail->parent('admin.interview_types');
    $trail->push('Create Interview Type', route('admin.interview_types.create'));
});

// Administration > Interview Types > Show
Breadcrumbs::for('admin.interview_types.show', function ($trail, $interview_type) {
    $trail->parent('admin.interview_types');
    $trail->push($interview_type->name.': Interviews', route('admin.interview_types.show', $interview_type->id));
});

// Administration > Interview Types > Edit
Breadcrumbs::for('admin.interview_types.edit', function ($trail, $interview_type) {
    $trail->parent('admin.interview_types');
    $trail->push($interview_type->name.': Edit', route('admin.interview_types.edit', $interview_type->id));
});

// Administration > Interview Types > Delete
Breadcrumbs::for('admin.interview_types.delete', function ($trail, $interview_type) {
    $trail->parent('admin.interview_types');
    $trail->push($interview_type->name.': Delete', route('admin.interview_types.delete', $interview_type->id));
});



/* ------------------------------------------------------------------ */
// Staff
Breadcrumbs::for('staff', function ($trail) {
    $trail->push('Staff');
});

// Staff > Interviews
Breadcrumbs::for('staff.interviews', function ($trail) {
    $trail->parent('staff');
    $trail->push('Interviews', route('staff.interviews'));
});


/* ------------------------------------------------------------------ */
// Student
Breadcrumbs::for('student', function ($trail) {
    $trail->push('Student');
});

// Student > Interviews
Breadcrumbs::for('student.interviews', function ($trail) {
    $trail->parent('student');
    $trail->push('Interviews', route('student.interviews'));
});

// Student > Interviews > Create Interview
Breadcrumbs::for('student.interviews.create', function ($trail) {
    $trail->parent('student.interviews');
    $trail->push('Create Interview', route('student.interviews.create'));
});