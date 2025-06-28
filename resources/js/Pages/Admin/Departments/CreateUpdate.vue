<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';
const props = defineProps({
    pageTitle: String,
    departments: Object
});

const form  = useForm({
    _method: props.departments?.id ? 'PUT' : 'POST',
    name: props.departments?.name,
    code: props.departments?.code,
    description: props.departments?.description,
    head_of_department_id: props.departments?.head_of_department_id,
    parent_department_id: props.departments?.parent_department_id,
    budget: props.departments?.budget,
    contact_email: props.departments?.contact_email,
    contact_phone: props.departments?.contact_phone,
    
});

const createNewDept = () => {
    const id = props.departments?.id ?? null;
    if(id) {
        form.post(route('departments.update', [id])), {
            preserveScroll: true,
        }
    } else {
        form.post(route('departments.store')), {
            preserveScroll: true,
        }
    }
};


</script>

<template>
    <AppLayout title="Departments">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Departments
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <FormSection @submitted="createNewDept">
                    <template #title>
                        Department Information
                    </template>
                    <template #description>
                        This Section Creates New Department
                    </template>
                
                    <template #form>
                        <!---Name-->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="name" value="Name" />
                            <TextInput
                                id="name"
                                v-model="form.name"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="name"
                            />
                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>
                        <!-- Code -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="code" value="Code" />
                            <TextInput
                                id="code"
                                v-model="form.code"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="code"
                            />
                            <InputError :message="form.errors.code" class="mt-2" />
                        </div>
                        <!-- Description -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="description" value="Description" />
                            <TextInput
                                id="description"
                                v-model="form.description"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="description"
                            />
                            <InputError :message="form.errors.description" class="mt-2" />
                        </div>
                        <!-- Head of Department -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="headOfDepartment" value="Head Of Department" />
                            <TextInput
                                id="headOfDepartment"
                                v-model="form.head_of_department_id"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="headOfDepartment"
                            />
                            <InputError :message="form.errors.head_of_department_id" class="mt-2" />
                        </div>
                        <!-- Parent Department -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="parentDepartment" value="Parent Department" />
                            <TextInput
                                id="parentDepartment"
                                v-model="form.parent_department_id"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="parentDepartment"
                            />
                            <InputError :message="form.errors.parent_department_id" class="mt-2" />
                        </div>
                        <!-- Budget -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="budget" value="Budget" />
                            <TextInput
                                id="budget"
                                v-model="form.budget"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="budget"
                            />
                            <InputError :message="form.errors.budget" class="mt-2" />
                        </div>
                        <!-- Contact Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="contactEmail" value="Contact Email" />
                            <TextInput
                                id="contactEmail"
                                v-model="form.contact_email"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="contactEmail"
                            />
                            <InputError :message="form.errors.contact_email" class="mt-2" />
                        </div>
                        <!-- Contact Phone -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="contactPhone" value="Contact Phone" />
                            <TextInput
                                id="contactPhone"
                                v-model="form.contact_phone"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="contactPhone"
                            />
                            <InputError :message="form.errors.contact_phone" class="mt-2" />
                        </div>
                    </template>

                    <template #actions>
                        <ActionMessage :on="form.recentlySuccessful" class="me-3">
                            Created.
                        </ActionMessage>
                    
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Create
                        </PrimaryButton>
                    </template>
                </FormSection>
            </div>
        </div>
    </AppLayout>
</template>