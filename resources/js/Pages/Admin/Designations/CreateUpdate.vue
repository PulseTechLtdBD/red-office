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
    designation: Object
});

const form  = useForm({
    _method: 'POST',
    name: props.organization?.name,
    description: props.organization?.description,
    level: props.organization?.level,
    contact_email: props.organization?.contact_email,
    contact_phone: props.organization?.contact_phone,
    
});

const createNewDesignation = () => {
    form.post(route('designations.store')), {
        preserveScroll: true,
    }
};


</script>

<template>
    <AppLayout title="Designations">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Designations
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <FormSection @submitted="createNewOrg">
                    <template #title>
                        Designation Information
                    </template>
                    <template #description>
                        This Section Creates New Designation
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
                            <InputError :message="form.errors.parentId" class="mt-2" />
                        </div>
                        <!-- Level -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="level" value="Level" />
                            <TextInput
                                id="level"
                                v-model="form.level"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="level"
                            />
                            <InputError :message="form.errors.latitude" class="mt-2" />
                        </div>
                        <!-- Contact Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="contactEmail" value="Contact Email" />
                            <TextInput
                                id="contactEmail"
                                v-model="form.contactEmail"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="contactEmail"
                            />
                            <InputError :message="form.errors.longitude" class="mt-2" />
                        </div>
                        <!-- Contact Phone -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="contactPhone" value="Contact Phone" />
                            <TextInput
                                id="contactPhone"
                                v-model="form.contactPhone"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="contactPhone"
                            />
                            <InputError :message="form.errors.longitude" class="mt-2" />
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