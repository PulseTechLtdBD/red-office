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
    organizations: Object
});

const form  = useForm({
    _method: 'POST',
    name: props.organizations?.name,
    parent_id: props.organizations?.parent_id,
    type: props.organizations?.type,
    contact_email: props.organizations?.contact_email,
    contact_name: props.organizations?.contact_name,
    website_url: props.organizations?.website_url,
    founded_at: props.organizations?.founded_at,
    
});

const createNewOrg = () => {
    form.post(route('organizations.store')), {
        preserveScroll: true,
    }
};


</script>

<template>
    <AppLayout title="Organizations">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Organizations
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <FormSection @submitted="createNewOrg">
                    <template #title>
                        Organization Information
                    </template>
                    <template #description>
                        This Section Creates New Organization
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
                        <!-- Parent Organization -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="parentOrganization" value="Parent Organization" />
                            <TextInput
                                id="parentOrganization"
                                v-model="form.parent_id"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="parentOrganization"
                            />
                            <InputError :message="form.errors.parent_id" class="mt-2" />
                        </div>
                        <!-- Type -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="type" value="Type" />
                            <TextInput
                                id="type"
                                v-model="form.type"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="type"
                            />
                            <InputError :message="form.errors.type" class="mt-2" />
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
                        <!-- Contact Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="contactName" value="Contact Name" />
                            <TextInput
                                id="contactName"
                                v-model="form.contact_name"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="contactName"
                            />
                            <InputError :message="form.errors.contact_name" class="mt-2" />
                        </div>
                        <!-- Website URL -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="websiteUrl" value="Website URL" />
                            <TextInput
                                id="websiteUrl"
                                v-model="form.website_url"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="websiteUrl"
                            />
                            <InputError :message="form.errors.website_url" class="mt-2" />
                        </div>
                        <!-- Founded At -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="foundedAt" value="Founded At" />
                            <TextInput
                                id="foundedAt"
                                v-model="form.founded_at"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="foundedAt"
                            />
                            <InputError :message="form.errors.founded_at" class="mt-2" />
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