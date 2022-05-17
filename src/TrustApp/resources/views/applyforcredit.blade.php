@extends('layouts.admin')

@section('main-content')
<header style="color: blue; font-size: 20px;">Weekly Credit Application Form</header>
<div class="card justify-content-center">
    <div class="card-body">
        <form class="col-sm-6 justify-content-center" [formGroup]="FormData" (ngSubmit)="onSubmit(FormData.value)" action="ec2-3-101-18-102.us-west-1.compute.amazonaws.com" method="POST">

            <div class="form-group">
                <label for="fullname">Applicant Full name</label>
                    <input
                        type="text"
                        class="form-control"
                        name="Fullname"
                        placeholder="Full Name"
                        formControlName="Fullname"
                    />

            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                    <input
                        type="email"
                        class="form-control" name="Email"
                        aria-describedby="emailHelp"
                        placeholder="Enter Email"
                        formControlName="Email"
                        ng-required="true"
                    />
            </div>
            <div class="form-group">
                <label for="serviceneeded">Employer's Name</label>
                    <input
                        type="text"
                        class="form-control" name="employer"
                        aria-describedby="Employer"
                        placeholder="Enter Employer Name"
                        formControlName="Employer"
                        ng-required="true"
                    />
            </div>
            <div class="form-group">
                <label for="income">Monthly Salary</label>
                    <input
                        type="number"
                        class="form-control" name="income"
                        aria-describedby="income"
                        placeholder="Monthly Income"
                        formControlName="Income"
                        ng-required="true"
                    />
            </div>
            <div class="form-group">
                <label for="employmail">Employer's Email</label>
                    <input
                        type="email"
                        class="form-control"
                        name="EmployerEmail"
                        placeholder="Employer Email"
                        formControlName="Employermail"
                    />

            </div>
            <div class="form-group">
                <label for="Message">Message</label>
                    <textarea class="form-control" id="formControlTextareaClient" formControlName="Message" rows="3" name="Message" rng-required="true"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </form>
    </div>
</div>
<br>
@endsection