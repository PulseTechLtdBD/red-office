<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
const props = defineProps({
    users: Array,
    areas : Array,
    departments: Array,
    designations: Array,
    userProfile: Object,
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
    gender: props.userProfile?.gender ?? '',
    blood_group: props.userProfile?.blood_group ?? '',
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
    profile_picture_src: null,

    per_address_type: 'home',
    per_address_name: 'permanent',
    per_address_street_address: '',
    per_address_apartment_address: '',
    per_address_area_id: '',
    per_address_zip_code: '',
    per_address_latitude: '',
    per_address_longitude: '',
    per_address_is_primary: 1,
    per_address_contact_name: '',
    per_address_contact_phone: '',

    pre_address_type: 'home',
    pre_address_name: 'present',
    pre_address_street_address: '',
    pre_address_apartment_address: '',
    pre_address_area_id: '',
    pre_address_zip_code: '',
    pre_address_latitude: '',
    pre_address_longitude: '',
    pre_address_is_primary: 1,
    pre_address_contact_name: '',
    pre_address_contact_phone: '',
    // _method: props.address? 'PUT' : 'POST',
    // type: props.address?.type ?? 'home',
    // name: props.address?.name ?? '',
    // street_address: props.address?.street_address ?? '',
    // apartment_address: props.address?.apartment_address ?? '',
    // area_id: props.address?.area_id ?? '',
    // zip_code: props.address?.zip_code ?? '',
    // latitude: props.address?.latitude ?? '',
    // longitude: props.address?.longitude ?? '',
    // is_primary: props.address?.is_primary ?? 1,
    // contact_name: props.address?.contact_name ?? '',
    // contact_phone: props.address?.contact_phone ?? '',
    // addressable_id: props.address?.addressable_id ?? '',
    // addressable_type: props.address?.addressable_type ?? '',

    // _method: props.area?.id ? 'PUT' : 'POST',
    // name: props.area?.name ?? '',
    // parent_id: props.area?.parent_id ?? '',
    // latitude: props.area?.latitude ?? '',
    // longitude: props.area?.longitude ?? '',
    // area_type: props.area?.area_type ?? '',

});

const createNewProfile = () => {
    const id = props.userProfile?.id ?? null;  

    if(id) {
        form.post(route('user-profiles.update', [id]), {
            preserveScroll: true,
            forceFormData: true,
            _method: 'put'
        });
    } else {
        form.post(route('user-profiles.store'), {
            preserveScroll: true,
            forceFormData: true,
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
                                autocomplete="spouseName"
                            />
                            <InputError :message="form.errors.spouse_name" class="mt-2" />
                        </div>
                        <!-- Department -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="department" value="Department" />
                            <select 
                                id="department"
                                v-model="form.department_id"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
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
                        <!-- Designation -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="designation" value="Designation" />
                            <select 
                                id="designation"
                                v-model="form.designation_id"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
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
                        <!-- Joined At -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="joinedAt" value="Joined At" />
                            <TextInput
                                id="joinedAt"
                                v-model="form.joined_at"
                                type="date"
                                class="mt-1 block w-full"
                                autocomplete="joinedAt"
                            />
                            <InputError :message="form.errors.joined_at" class="mt-2" />
                        </div>
                        <!-- Employee Type -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="employeeType" value="Employee Type" />
                            <select id="employeeType"
                                    v-model="form.employee_type" 
                                    class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
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
                                type="date"
                                class="mt-1 block w-full"
                                autocomplete="dateOfBirth"
                            />
                            <InputError :message="form.errors.date_of_birth" class="mt-2" />
                        </div>
                        <!-- Gender -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="gender" value="Gender" />
                            <select id="gender"
                                    v-model="form.gender"
                                    class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                    >
                                <option value="" disabled>--Select Gender --</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            <InputError :message="form.errors.gender" class="mt-2" />
                        </div>
                        <!-- Blood Group -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="bloodGroup" value="Blood Group" />
                            <select id="bloodGroup"
                                    v-model="form.blood_group"
                                    class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                    >
                                <option value="" disabled>--Select Blood Group --</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
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
                                autocomplete="drivingLicenseNo"
                            />
                            <InputError :message="form.errors.driving_license_no" class="mt-2" />
                        </div>
                        <!-- Employee Status -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="employeeStatus" value="Employee Status" />
                            <select id="employeeStatus"
                                    v-model="form.employee_status" 
                                    class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
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
                            <select class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                    id="maritalStatus"
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
                                autocomplete="emergencyContactNumber"
                            />
                            <InputError :message="form.errors.emergency_contact_number" class="mt-2" />
                        </div>
                        <!-- Profile Picture Upload -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="profilePicture" value="Profile Picture" />
                            <input 
                                id="profilePicture"
                                type="file"
                                class="mt-1 block w-full"
                                @change="e => form.profile_picture_src = e.target.files[0]"
                            />
                            <InputError :message="form.errors.profile_picture_src" class="mt-2" />
                        </div>
                        <!---Permanent Address Type-->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="permanentAddressType" value="Permanent Address Type" />
                            <select class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                    id="permanentAddressType"
                                    v-model="form.per_address_type"
                                    >
                                    <option value="home">Home Address</option>   
                                    <option value="office">Office Address</option>
                            </select>
                            <InputError :message="form.errors.per_address_type" class="mt-2" />
                        </div>
                        <!---Permanent Address Name-->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="permanentAddressName" value="Permanent Address Name" />
                            <TextInput
                                id="permanentAddressName"
                                v-model="form.per_address_name"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="permanentAddressName"
                            />
                            <InputError :message="form.errors.per_address_name" class="mt-2" />
                        </div>
                        <!-- Permanent Street Address -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="permanentStreetAddress" value="Permanent Street Address" />
                            <TextInput
                                id="permanentStreetAddress"
                                v-model="form.per_address_street_address"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="permanentStreetAddress"
                            />
                            <InputError :message="form.errors.per_address_street_address" class="mt-2" />
                        </div>
                        <!-- Permanent Apartment Address -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="permanentApartmentAddress" value="Permanent Apartment Address" />
                            <TextInput
                                id="permanentApartmentAddress"
                                v-model="form.per_address_apartment_address"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="permanentApartmentAddress"
                            />
                            <InputError :message="form.errors.per_address_apartment_address" class="mt-2" />
                        </div>
                        <!-- Permanent Area ID -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="permanentAreaID" value="Permanent Area" />
                            <select 
                                id="permanentAreaID"
                                v-model="form.per_address_area_id"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                required
                                >
                                <option value="" disabled>-- Select Area --</option>
                                <option 
                                v-for="area in props.areas"
                                :key="area.id"
                                :value="area.id"
                            >
                                {{ area.name }}
                                </option>
                            </select>
                            <InputError :message="form.errors.per_address_area_id" class="mt-2" />
                        </div>
                        <!-- Permanent Zip Code -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="permanentZipCode" value="Permanent Zip Code" />
                            <TextInput
                                id="permanentZipCode"
                                v-model="form.per_address_zip_code"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="permanentZipCode"
                            />
                            <InputError :message="form.errors.per_address_zip_code" class="mt-2" />
                        </div>
                        <!-- Permanent Latitude -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="permanentLatitude" value="Permanent Latitude" />
                            <TextInput
                                id="permanentLatitude"
                                v-model="form.per_address_latitude"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="permanentLatitude"
                            />
                            <InputError :message="form.errors.per_address_latitude" class="mt-2" />
                        </div>
                        <!-- Permanent Longitude -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="permanentLongitude" value="Permanent Longitude" />
                            <TextInput
                                id="permanentLongitude"
                                v-model="form.per_address_longitude"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="permanentLongitude"
                            />
                            <InputError :message="form.errors.per_address_longitude" class="mt-2" />
                        </div>
                        <!-- Permanent Is Primary -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="permanentIsPrimary" value="Permanent Is Primary" />
                            <select class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                    id="permanentIsPrimary"
                                    v-model="form.per_address_is_primary"
                                    >
                                <option value="1">Primary</option>
                                <option value="0">Non-Primary</option>
                            </select>
                            <InputError :message="form.errors.per_address_is_primary" class="mt-2" />
                        </div>
                        <!-- Permanent Contact Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="permanentContactName" value="Permanent Contact Name" />
                            <TextInput
                                id="permanentContactName"
                                v-model="form.per_address_contact_name"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="permanentContactName"
                            />
                            <InputError :message="form.errors.per_address_contact_name" class="mt-2" />
                        </div>
                        <!-- Permanent Contact Phone -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="permanentContactPhone" value="Permanent Contact Phone" />
                            <TextInput
                                id="permanentContactPhone"
                                v-model="form.per_address_contact_phone"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="permanentContactPhone"
                            />
                            <InputError :message="form.errors.per_address_contact_phone" class="mt-2" />
                        </div>
                        <!---Present Address Type-->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="presentAddressType" value="Present Address Type" />
                            <select class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                    id="presentAddressType"
                                    v-model="form.pre_address_type"
                                    >
                                    <option value="home">Home Address</option>   
                                    <option value="office">Office Address</option>
                            </select>
                            <InputError :message="form.errors.pre_address_type" class="mt-2" />
                        </div>
                        <!---Present Address Name-->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="presentAddressName" value="Present Address Name" />
                            <TextInput
                                id="presentAddressName"
                                v-model="form.pre_address_name"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="presentAddressName"
                            />
                            <InputError :message="form.errors.pre_address_name" class="mt-2" />
                        </div>
                        <!-- Present Street Address -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="presentStreetAddress" value="Present Street Address" />
                            <TextInput
                                id="presentStreetAddress"
                                v-model="form.pre_address_street_address"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="presentStreetAddress"
                            />
                            <InputError :message="form.errors.pre_address_street_address" class="mt-2" />
                        </div>
                        <!-- Present Apartment Address -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="presentApartmentAddress" value="Present Apartment Address" />
                            <TextInput
                                id="presentApartmentAddress"
                                v-model="form.pre_address_apartment_address"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="presentApartmentAddress"
                            />
                            <InputError :message="form.errors.pre_address_apartment_address" class="mt-2" />
                        </div>
                        <!-- Present Area ID -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="presentAreaID" value="Present Area" />
                            <select 
                                id="presentAreaID"
                                v-model="form.pre_address_area_id"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                >
                                <option value="" disabled>-- Select Area --</option>
                                <option 
                                v-for="area in props.areas"
                                :key="area.id"
                                :value="area.id"
                            >
                                {{ area.name }}
                                </option>
                            </select>
                            <InputError :message="form.errors.pre_address_area_id" class="mt-2" />
                        </div>
                        <!-- Present Zip Code -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="presentZipCode" value="Present Zip Code" />
                            <TextInput
                                id="presentZipCode"
                                v-model="form.pre_address_zip_code"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="presentZipCode"
                            />
                            <InputError :message="form.errors.pre_address_zip_code" class="mt-2" />
                        </div>
                        <!-- Present Latitude -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="presentLatitude" value="Present Latitude" />
                            <TextInput
                                id="presentLatitude"
                                v-model="form.pre_address_latitude"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="presentLatitude"
                            />
                            <InputError :message="form.errors.pre_address_latitude" class="mt-2" />
                        </div>
                        <!-- Present Longitude -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="presentLongitude" value="Present Longitude" />
                            <TextInput
                                id="presentLongitude"
                                v-model="form.pre_address_longitude"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="presentLongitude"
                            />
                            <InputError :message="form.errors.pre_address_longitude" class="mt-2" />
                        </div>
                        <!-- Present Is Primary -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="presentIsPrimary" value="Present Is Primary" />
                            <select class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                    id="presentIsPrimary"
                                    v-model="form.pre_address_is_primary"
                                    >
                                <option value="1">Primary</option>
                                <option value="0">Non-Primary</option>
                            </select>
                            <InputError :message="form.errors.pre_address_is_primary" class="mt-2" />
                        </div>
                        <!-- Present Contact Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="presentContactName" value="Present Contact Name" />
                            <TextInput
                                id="presentContactName"
                                v-model="form.pre_address_contact_name"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="presentContactName"
                            />
                            <InputError :message="form.errors.pre_address_contact_name" class="mt-2" />
                        </div>
                        <!-- Present Contact Phone -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="presentContactPhone" value="Present Contact Phone" />
                            <TextInput
                                id="presentContactPhone"
                                v-model="form.pre_address_contact_phone"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="presentContactPhone"
                            />
                            <InputError :message="form.errors.pre_address_contact_phone" class="mt-2" />
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