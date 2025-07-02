<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm, router } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
const props = defineProps({
    userProfiles: Object
});

function onEdit(id) {
    const form = useForm({});
    router.get(route('user-profiles.edit', id));
}

function onDelete(id) {
    console.log(id);
}

function onCreate() {
    const form = useForm({});
    router.get(route('user-profiles.create'));
}

</script>

<template>
    <AppLayout title="User Profiles">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    User Profiles
                </h2>
                <PrimaryButton @click="onCreate">
                    Create 
                </PrimaryButton>
            </div>
        </template>
        <div class="py-9">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-x-auto shadow-xl sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Users</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">First Name</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Middle Name</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Last Name</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Father's Name</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Mother's Name</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Spouse's Name</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Designation</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Department</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Joined At</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Employee Type</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Date of Birth</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Gender</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Blood Group</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">National ID</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Employee ID</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Passport No.</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Driving License No.</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Employee Status</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Marital Status</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Religion</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Nationality</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Emergency Contact Name</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Emergency Contact Number</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Profile Picture</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="item in props.userProfiles">
                                <td class="px-4 py-2 text-center">{{ item.id }}</td>
                                <td class="px-4 py-2 text-center">{{ item.user?.name ?? '-' }}</td>
                                <td class="px-4 py-2 text-center">{{ item.first_name }}</td>
                                <td class="px-4 py-2 text-center">{{ item.middle_name }}</td>
                                <td class="px-4 py-2 text-center">{{ item.last_name }}</td>
                                <td class="px-4 py-2 text-center">{{ item.father_name }}</td>
                                <td class="px-4 py-2 text-center">{{ item.mother_name }}</td>
                                <td class="px-4 py-2 text-center">{{ item.spouse_name }}</td>
                                <td class="px-4 py-2 text-center">{{ item.designation?.name ?? '-' }}</td>
                                <td class="px-4 py-2 text-center">{{ item.department?.name ?? '-' }}</td>
                                <td class="px-4 py-2 text-center">{{ item.joined_at }}</td>
                                <td class="px-4 py-2 text-center">{{ item.employee_type }}</td>
                                <td class="px-4 py-2 text-center">{{ item.date_of_birth }}</td>
                                <td class="px-4 py-2 text-center">{{ item.gender }}</td>
                                <td class="px-4 py-2 text-center">{{ item.blood_group }}</td>
                                <td class="px-4 py-2 text-center">{{ item.national_id }}</td>
                                <td class="px-4 py-2 text-center">{{ item.employee_id }}</td>
                                <td class="px-4 py-2 text-center">{{ item.passport_no }}</td>
                                <td class="px-4 py-2 text-center">{{ item.driving_license_no }}</td>
                                <td class="px-4 py-2 text-center">{{ item.employee_status }}</td>
                                <td class="px-4 py-2 text-center">{{ item.marital_status }}</td>
                                <td class="px-4 py-2 text-center">{{ item.religion }}</td>
                                <td class="px-4 py-2 text-center">{{ item.nationality }}</td>
                                <td class="px-4 py-2 text-center">{{ item.emergency_contact_name }}</td>
                                <td class="px-4 py-2 text-center">{{ item.emergency_contact_number }}</td>
                                <td class="px-4 py-2 text-center">{{ item.profile_picture_src }}</td>
                                <td class="px-4 py-2 text-center space-x-2">
                                    <div class="flex space-x-2 items-center justify-center">
                                        <PrimaryButton @click="onEdit(item.id)">Edit</PrimaryButton>
                                        <PrimaryButton @click="onDelete(item.id)">Delete</PrimaryButton>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>