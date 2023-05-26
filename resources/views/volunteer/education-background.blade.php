@extends('layouts.app')
@section('title', 'Volunteer Registration | Fiji Red Cross Society')
@section('content')
    <section>
        <div class="container pt-3">
            <h3 class="text-center">Volunteer Registration</h3>
        </div>
    </section>
    <section>
        <div class="container pt-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title text-center fw-bold">Education Background</h4>
                    <p class="text-center text-muted">Step 7</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('education-background') }}" method="POST" id="educationBackgroundForm" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-12">
                            <label for="highest_level_of_education" class="col-form-label">Highest Level of Education <span
                                    class="text-danger">*</span></label>
                            <select id="highest_level_of_education"
                                class="form-select @error('highest_level_of_education') is-invalid @enderror" name="highest_level_of_education">
                                <option value="">Select Highest Level of Education</option>
                                <option value="Doctorate" {{ old('highest_level_of_education') == 'Doctorate' ? 'selected' : '' }}>
                                    Doctorate
                                </option>
                                <option value="Degree"
                                    {{ old('highest_level_of_education') == 'Degree' ? 'selected' : '' }}>Degree
                                </option>
                                <option value="Certificate" {{ old('highest_level_of_education') == 'Certificate' ? 'selected' : '' }}>
                                    Certificate
                                </option>
                                <option value="Primary Schoool" {{ old('highest_level_of_education') == 'Primary Schoool' ? 'selected' : '' }}>Primary Schoool
                                </option>  
                                <option value="Secondary School" {{ old('highest_level_of_education') == 'Secondary School' ? 'selected' : '' }}>Secondary School
                                </option>
                                <option value="Special School" {{ old('highest_level_of_education') == 'Special School' ? 'selected' : '' }}>Special School
                                </option>    
                                <option value="Masters" {{ old('highest_level_of_education') == 'Masters' ? 'selected' : '' }}>Masters
                                </option>                                  
                                <option value="Foundation" {{ old('highest_level_of_education') == 'Foundation' ? 'selected' : '' }}>Foundation
                                </option> 
                                <option value="Year 11" {{ old('highest_level_of_education') == 'Year 11' ? 'selected' : '' }}>Year 11
                                </option> 
                                <option value="Year 12" {{ old('highest_level_of_education') == 'Year 12' ? 'selected' : '' }}>Year 12
                                </option>                           
                                <option value="Diploma" {{ old('highest_level_of_education') == 'Diploma' ? 'selected' : '' }}>Diploma
                                </option> 
                                <option value="Post graduation Diploma" {{ old('highest_level_of_education') == 'Post graduation Diploma' ? 'selected' : '' }}>Post graduation Diploma
                                </option>
                                <option value="No Formal Education" {{ old('highest_level_of_education') == 'No Formal' ? 'selected' : '' }}>No Formal
                                </option> 
                                                                                   
                            </select>
                            @error('highest_level_of_education')
                                <small id="highest_level_of_education-error" class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>  
                        <div class="col-lg-12">
                            <label class="col-form-label">Tertiary Qualifications Attained (including Vocational Programs) </label>
                        </div>
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-sm table-bordered" id="qualifications">
                                <thead>
                                    <tr>
                                        <th>Year</th>
                                        <th>Institution</th>
                                        <th>Course / Field of Study</th>
                                        <th>Course Status</th>
                                        <th>Upload Evidence of Course Completed</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="qualification-row0">
                                        <td><input type="text" class="form-control form-control-sm" name="qualification[0][year]" onkeypress="return isNumberKey(event)" maxlength="4"></td>
                                        <td><input type="text" class="form-control form-control-sm" name="qualification[0][institution]"></td>
                                        <td><input type="text" class="form-control form-control-sm" name="qualification[0][course]"></td>
                                        <td>
                                            <select name="qualification[0][course_status]" class="form-select form-control-sm">
                                                <option value="">Select</option>
                                                <option value="Complete">Complete</option>
                                                <option value="Ongoing">Ongoing</option>
                                                <option value="Incomplete">Incomplete</option>
                                                
                                            </select>
                                        </td>
                                        <td><input type="file" class="form-control form-control-sm" name="qualification[0][evidence]"></td>
                                        <td><button class="btn btn-sm btn-danger" onclick="$('#qualification-row0').remove();"><i class="mdi mdi-delete"></i></button></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" class="text-end">
                                            <button type="button" class="btn btn-sm btn-info"
                                                onclick="addQualification();"><i class="mdi mdi-plus"></i></button>
                                        </td>
                                    </tr>
                                </tfoot>                                
                            </table>
                        </div>
                        <div class="col-lg-12">
                            <label class="col-form-label">List Other Work or Professional Skills: (e.g. driver, carpentdr, welder etc.)</label>
                        </div>
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-sm table-bordered" id="skills">
                                <thead>
                                    <tr>
                                        <th>Skill</th>                                      
                                        <th>Evidence of Skills (e.g. certificates or reference letters)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="skill-row0">                                      
                                        <td><input type="text" class="form-control form-control-sm" name="skill[0][skill]"></td>                                        
                                        <td><input type="file" class="form-control form-control-sm" name="skill[0][evidence]"></td>
                                        <td class="text-end"><button class="btn btn-sm btn-danger" onclick="$('#skill-row0').remove();"><i class="mdi mdi-delete"></i></button></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-end">
                                            <button type="button" class="btn btn-sm btn-info"
                                                onclick="addSkill();"><i class="mdi mdi-plus"></i></button>
                                        </td>
                                    </tr>
                                </tfoot>                                
                            </table>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{ route('identification-and-employement-details.form') }}" class="btn btn-sm btn-warning float-start">Previous
                        Step</a>
                    <button type="submit" form="educationBackgroundForm" class="btn btn-sm btn-success float-end">Next
                        Step</button>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container pt-1 pb-3">
            <ul>
                <li>
                    Please note that all the information bothered here is treated as "Confidential". Information will only be
                    used for the management of members and volunteers and access Is limited to <strong> authorised persons
                        only.</strong>
                </li>
                <li>Volunteers will have to re-register if inactive for more than 2 years</li>
            </ul>           
        </div>
    </section>
@endsection
@push('scripts')
<script>
    var qualification_row = 1;
    function addQualification(){
        html =  '<tr id="qualification-row' +qualification_row+ '">';
        html += '<td><input type="text" class="form-control form-control-sm" name="qualification[' +qualification_row+ '][year]" onkeypress="return isNumberKey(event)" maxlength="4"></td>';
        html += '<td><input type="text" class="form-control form-control-sm" name="qualification[' +qualification_row+ '][institution]"></td>'
        html += '<td><input type="text" class="form-control form-control-sm" name="qualification[' +qualification_row+ '][course]"></td>'
        html += '<td><select  class="form-select form-control-sm" name="qualification[' +qualification_row+ '][course_status]"><option value="">Select</option><option value="Complete">Complete</option><option value="Ongoing">Ongoing</option><option value="Incomplete">Incomplete</option></select></td>';
        html += '<td><input type="file" class="form-control form-control-sm" name="qualification[' +qualification_row+ '][evidence]"></td>';
        html += '<td><button class="btn btn-sm btn-danger" onclick="$(\'#qualification-row' + qualification_row + '\').remove();"><i class="mdi mdi-delete"></i></button></td>';
        html += '</tr>';

        $('#qualifications tbody').append(html);

        qualification_row++;
    }
</script>
<script>
    var skill_row = 1;
    function addSkill(){
        html =  '<tr id="skill-row' +skill_row+ '">';       
        html += '<td><input type="text" class="form-control form-control-sm" name="skill[' +skill_row+ '][skill]"></td>'      
        html += '<td><input type="file" class="form-control form-control-sm" name="skill[' +skill_row+ '][evidence]"></td>';
        html += '<td class="text-end"><button class="btn btn-sm btn-danger" onclick="$(\'#skill-row' + skill_row + '\').remove();"><i class="mdi mdi-delete"></i></button></td>';
        html += '</tr>';

        $('#skills tbody').append(html);

        skill_row++;
    }
</script>
@endpush