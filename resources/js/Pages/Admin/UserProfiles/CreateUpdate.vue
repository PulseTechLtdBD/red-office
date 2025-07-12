<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
const props = defineProps({
    users: Array,
    departments: Array,
    designations: Array,
    userProfile: Object
});

const form  = useForm({
    _method: props.userProfile? 'PUT' : 'POST',
    user_id: props.userProfile?.user_id ?? '',
    first_name: props.userProfile?.first_name,
    middle_name: props.userProfile?.middle_name,
    last_name: props.userProfile?.last_name,
    father_name: props.userProfile?.father_name,
    mother_name: props.userProfile?.mother_name,
    spouse_name: props.userProfile?.spouse_name,
    designation_id: props.userProfile?.designation_id ?? '',
    department_id: props.userProfile?.department_id ?? '',
    joined_at: props.userProfile?.joined_at,
    employee_type: props.userProfile?.employee_type ?? '',
    date_of_birth: props.userProfile?.date_of_birth,
    gender: props.userProfile?.gender,
    blood_group: props.userProfile?.blood_group,
    national_id: props.userProfile?.national_id,
    employee_id: props.userProfile?.employee_id,
    passport_no: props.userProfile?.passport_no,
    driving_license_no: props.userProfile?.driving_license_no,
    employee_status: props.userProfile?.employee_status ?? 1,
    marital_status: props.userProfile?.marital_status ?? '',
    religion: props.userProfile?.religion,
    nationality: props.userProfile?.nationality,
    emergency_contact_name: props.userProfile?.emergency_contact_name,
    emergency_contact_number: props.userProfile?.emergency_contact_number,
    profile_picture_src: props.userProfile?.profile_picture_src,
});

const createNewProfile = () => {
    const id = props.userProfile?.id ?? null;

    if(id) {
        form.put(route('user-profiles.update', [id]), {
            preserveScroll: true,
        });
    } else {
        form.post(route('user-profiles.store'), {
            preserveScroll: true,
        });
    }    
};


</script>

<template>
    <AppLayout title="Profiles">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Profiles
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <FormSection @submitted="createNewProfile">
                    <template #title>
                        Profile Information
                    </template>
                    <template #description>
                        {{ props.userProfile?.id ? 'This Section Updates A New Profile' : 'This Section Creates A New Profile' }}
                    </template>
                
                    <template #form>
                        <!---User ID-->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="userId" value="User" />
                            <select 
                                id="userId"
                                v-model="form.user_id"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            >
                                <option value="" disabled>-- Select User --</option>
                                <option 
                                v-for="user in props.users"
                                :key="user.id"
                                :value="user.id"
                            >
                                {{ user.name }}
                                </option>
                            </select>
                            <InputError :message="form.errors.user_id" class="mt-2" />
                        </div>
                        <!-- First Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="firstName" value="First Name" />
                            <TextInput
                                id="firstName"
                                v-model="form.first_name"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="firstName"
                            />
                            <InputError :message="form.errors.first_name" class="mt-2" />
                        </div>
                        <!-- Middle Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="middleName" value="Middle Name" />
                            <TextInput
                                id="middleName"
                                v-model="form.middle_name"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="middleName"
                            />
                            <InputError :message="form.errors.middle_name" class="mt-2" />
                        </div>
                        <!-- Last Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="lastName" value="Last Name" />
                            <TextInput
                                id="lastName"
                                v-model="form.last_name"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="lastName"
                            />
                            <InputError :message="form.errors.last_name" class="mt-2" />
                        </div>
                        <!-- Father's Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="fatherName" value="Father's Name" />
                            <TextInput
                                id="fatherName"
                                v-model="form.father_name"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="fatherName"
                            />
                            <InputError :message="form.errors.father_name" class="mt-2" />
                        </div>
                        <!-- Mother's Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="motherName" value="Mother Name" />
                            <TextInput
                                id="motherName"
                                v-model="form.mother_name"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="motherName"
                            />
                            <InputError :message="form.errors.mother_name" class="mt-2" />
                        </div>
                        <!-- Spouse Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="spouseName" value="Spouse Name" />
                            <TextInput
                                id="spouseName"
                                v-model="form.spouse_name"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="spouseName"
                            />
                            <InputError :message="form.errors.spouse_name" class="mt-2" />
                        </div>
                        <!-- Designation -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="designation" value="Designation" />
                            <select 
                                id="designation"
                                v-model="form.designation_id"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                required
                                >
                                <option value="" disabled>-- Select Designation --</option>
                                <option 
                                v-for="designation in props.designations"
                                :key="designation.id"
                                :value="designation.id"
                                >
                                {{ designation.name }}
                                </option>
                            </select>
                            <InputError :message="form.errors.designation_id" class="mt-2" />
                        </div>
                        <!-- Department -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="department" value="Department" />
                            <select 
                                id="department"
                                v-model="form.department_id"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                required
                                >
                                <option value="" disabled>-- Select Department --</option>
                                <option 
                                v-for="department in props.departments"
                                :key="department.id"
                                :value="department.id"
                            >
                                {{ department.name }}
                                </option>
                            </select>
                            <InputError :message="form.errors.department_id" class="mt-2" />
                        </div>
                        <!-- Joined At -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="joinedAt" value="Joined At" />
                            <TextInput
                                id="joinedAt"
                                v-model="form.joined_at"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="joinedAt"
                            />
                            <InputError :message="form.errors.joined_at" class="mt-2" />
                        </div>
                        <!-- Employee Type -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="employeeType" value="Employee Type" />
                            <!-- <TextInput
                                id="employeeType"
                                v-model="form.employee_type"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="employeeType"
                            /> -->
                            <select id="employeeType"
                                    v-model="form.employee_type" 
                                    class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                    >
                                    <option value="" disabled>-- Select Employee Type --</option>
                                    <option value="fulltime">FullTime</option>
                                    <option value="parttime">PartTime</option>
                                    <option value="contract">Contract</option>
                                    <option value="intern">Intern</option>
                            </select>
                            <InputError :message="form.errors.employee_type" class="mt-2" />
                        </div>
                        <!-- Date of Birth -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="dateOfBirth" value="Date of Birth" />
                            <TextInput
                                id="dateOfBirth"
                                v-model="form.date_of_birth"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="dateOfBirth"
                            />
                            <InputError :message="form.errors.date_of_birth" class="mt-2" />
                        </div>
                        <!-- Gender -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="gender" value="Gender" />
                            <!-- <TextInput
                                id="gender"
                                v-model="form.gender"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="gender"
                            /> -->
                            <select id="gender"
                                    v-model="form.gender"
                                    class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                    >
                                <option value="" disabled>--Select Gender --</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <InputError :message="form.errors.gender" class="mt-2" />
                        </div>
                        <!-- Blood Group -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="bloodGroup" value="Blood Group" />
                            <TextInput
                                id="bloodGroup"
                                v-model="form.blood_group"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="bloodGroup"
                            />
                            <InputError :message="form.errors.blood_group" class="mt-2" />
                        </div>
                        <!-- National ID -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="nationalId" value="National ID" />
                            <TextInput
                                id="nationalId"
                                v-model="form.national_id"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="nationalId"
                            />
                            <InputError :message="form.errors.national_id" class="mt-2" />
                        </div>
                        <!-- Employee ID -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="employeeId" value="Employee ID" />
                            <TextInput
                                id="employeeId"
                                v-model="form.employee_id"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="employeeId"
                            />
                            <InputError :message="form.errors.employee_id" class="mt-2" />
                        </div>
                        <!-- Passport No -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="passportNo" value="Passport No" />
                            <TextInput
                                id="passportNo"
                                v-model="form.passport_no"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="passportNo"
                            />
                            <InputError :message="form.errors.passport_no" class="mt-2" />
                        </div>
                        <!-- Driving License No -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="drivingLicenseNo" value="Driving License No" />
                            <TextInput
                                id="drivingLicenseNo"
                                v-model="form.driving_license_no"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="drivingLicenseNo"
                            />
                            <InputError :message="form.errors.driving_license_no" class="mt-2" />
                        </div>
                        <!-- Employee Status -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="employeeStatus" value="Employee Status" />
                            <!-- <TextInput
                                id="employeeStatus"
                                v-model="form.employee_status"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="employeeStatus"
                            /> -->
                            <select id="employeeStatus"
                                    v-model="form.employee_status" 
                                    class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                    required
                                    >
                                <option value="" disabled>-- Select Employee Status --</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <InputError :message="form.errors.employee_status" class="mt-2" />
                        </div>
                        <!-- Marital Status -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="maritalStatus" value="Marital Status" />
                            <!-- <TextInput
                                id="maritalStatus"
                                v-model="form.marital_status"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="maritalStatus"
                            /> -->
                            <select class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                    id="maritalStatus"
                                    required 
                                    v-model="form.marital_status"
                                    >
                                <option value="" disabled>-- Select Marital Status --</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="divorced">Divorced</option>
                                <option value="widowed">Widowed</option>
                            </select>
                            <InputError :message="form.errors.marital_status" class="mt-2" />
                        </div>
                        <!-- Religion -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="religion" value="Religion" />
                            <TextInput
                                id="religion"
                                v-model="form.religion"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="religion"
                            />
                            <InputError :message="form.errors.religion" class="mt-2" />
                        </div>
                        <!-- Nationality -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="nationality" value="Nationality" />
                            <TextInput
                                id="nationality"
                                v-model="form.nationality"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="nationality"
                            />
                            <InputError :message="form.errors.nationality" class="mt-2" />
                        </div>
                        <!-- Emergency Contact Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="emergencyContactName" value="Emergency Contact Name" />
                            <TextInput
                                id="emergencyContactName"
                                v-model="form.emergency_contact_name"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="emergencyContactName"
                            />
                            <InputError :message="form.errors.emergency_contact_name" class="mt-2" />
                        </div>
                        <!-- Emergency Contact Number -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="emergencyContactNumber" value="Emergency Contact Number" />
                            <TextInput
                                id="emergencyContactNumber"
                                v-model="form.emergency_contact_number"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="emergencyContactNumber"
                            />
                            <InputError :message="form.errors.emergency_contact_number" class="mt-2" />
                        </div>
                        <!-- Profile Picture -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="profilePicture" value="Profile Picture" />
                            <TextInput
                                id="profilePicture"
                                v-model="form.profile_picture_src"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="profilePicture"
                            />
                            <InputError :message="form.errors.profile_picture_src" class="mt-2" />
                        </div>
                    </template>

                    <template #actions>
                        <ActionMessage :on="form.recentlySuccessful" class="me-3">
                            {{ props.userProfile?.id ? 'Updated.' : 'Created.' }}
                        </ActionMessage>
                    
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            {{ props.userProfile?.id ? 'Update' : 'Create' }}
                        </PrimaryButton>
                    </template>
                </FormSection>
            </div>
        </div>
    </AppLayout>
</template>