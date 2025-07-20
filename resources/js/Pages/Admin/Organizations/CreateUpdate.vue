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
    organization: Object,
    areas : Array,
    organizations: Array
});

const form  = useForm({
    _method: props.organization?.id ? 'PUT' : 'POST',
    name: props.organization?.name ?? '',
    parent_id: props.organization?.parent_id ?? '',
    type: props.organization?.type ?? '',
    contact_email: props.organization?.contact_email ?? '',
    contact_name: props.organization?.contact_name ?? '',
    website_url: props.organization?.website_url ?? '',
    founded_at: props.organization?.founded_at ?? '',

    org_address_type: 'org',
    org_address_name: 'organization',
    org_address_street_address: '',
    org_address_office_address: '',
    org_address_area_id: '',
    org_address_zip_code: '',
    org_address_latitude: '',
    org_address_longitude: '',
    org_address_is_primary: 1,
    org_address_contact_name: '',
    org_address_contact_phone: '',
    
});

const createNewOrg = () => {
    const id = props.organization?.id ?? null;

    if (id) {
        form.put(route('organizations.update', [id]), {
            preserveScroll: true,
        });
    } else {
        form.post(route('organizations.store'), {
            preserveScroll: true,
        });
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
                        {{ props.organization?.id ? 'This Section Updates An Organization' : 'This Section Creates An Organization'}}
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
                            <select 
                                id="parentOrganization"
                                v-model="form.parent_id"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            >
                                <option value="" disabled>-- Select Parent Organization --</option>
                                <option 
                                v-for="organization in props.organizations"
                                :key="organization.id"
                                :value="organization.id"
                            >
                                {{ organization.name }}
                                </option>
                            </select>
                            <InputError :message="form.errors.parent_id" class="mt-2" />
                        </div>
                        <!-- Type -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="type" value="Type" />
                            <select 
                                id="type"
                                v-model="form.type"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            >
                            <option value="" disabled>-- Select Organization Type--</option>
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                            </select>
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
                                type="date"
                                class="mt-1 block w-full"
                                required
                                autocomplete="foundedAt"
                            />
                            <InputError :message="form.errors.founded_at" class="mt-2" />
                        </div>
                        <!---Organization Address Type-->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="organizationAddressType" value="Organization Address Type" />
                            <select class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                    id="organizationAddressType"
                                    v-model="form.org_address_type"
                                    >
                                    <option value="org">Organization</option>   
                                    <option value="branch">Branch</option>
                            </select>
                            <InputError :message="form.errors.org_address_type" class="mt-2" />
                        </div>
                        <!---Organization Address Name-->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="organizationAddressName" value="Organization Address Name" />
                            <TextInput
                                id="organizationAddressName"
                                v-model="form.org_address_name"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="organizationAddressName"
                            />
                            <InputError :message="form.errors.org_address_name" class="mt-2" />
                        </div>
                        <!-- Organization Street Address -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="organizationStreetAddress" value="Organization Street Address" />
                            <TextInput
                                id="organizationStreetAddress"
                                v-model="form.org_address_street_address"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="organizationStreetAddress"
                            />
                            <InputError :message="form.errors.org_address_street_address" class="mt-2" />
                        </div>
                        <!-- Organization Office Address -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="organizationOfficeAddress" value="Organization Office Address" />
                            <TextInput
                                id="organizationOfficeAddress"
                                v-model="form.org_address_office_address"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="organizationOfficeAddress"
                            />
                            <InputError :message="form.errors.org_address_office_address" class="mt-2" />
                        </div>
                        <!-- Organization Area ID -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="organizationAreaID" value="Organization Area" />
                            <select 
                                id="organizationAreaID"
                                v-model="form.org_address_area_id"
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
                            <InputError :message="form.errors.org_address_area_id" class="mt-2" />
                        </div>
                        <!-- Organization Zip Code -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="organizationZipCode" value="Organization Zip Code" />
                            <TextInput
                                id="organizationZipCode"
                                v-model="form.org_address_zip_code"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="organizationZipCode"
                            />
                            <InputError :message="form.errors.org_address_zip_code" class="mt-2" />
                        </div>
                        <!-- Organization Latitude -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="organizationLatitude" value="Organization Latitude" />
                            <TextInput
                                id="organizationLatitude"
                                v-model="form.org_address_latitude"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="organizationLatitude"
                            />
                            <InputError :message="form.errors.org_address_latitude" class="mt-2" />
                        </div>
                        <!-- Organization Longitude -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="organizationLongitude" value="Organization Longitude" />
                            <TextInput
                                id="organizationLongitude"
                                v-model="form.org_address_longitude"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="organizationLongitude"
                            />
                            <InputError :message="form.errors.org_address_longitude" class="mt-2" />
                        </div>
                        <!-- Organization Is Primary -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="organizationIsPrimary" value="Organization Is Primary" />
                            <select class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                    id="organizationIsPrimary"
                                    v-model="form.org_address_is_primary"
                                    >
                                <option value="1">Primary</option>
                                <option value="0">Non-Primary</option>
                            </select>
                            <InputError :message="form.errors.org_address_is_primary" class="mt-2" />
                        </div>
                        <!-- Organization Contact Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="organizationContactName" value="Organization Contact Name" />
                            <TextInput
                                id="organizationContactName"
                                v-model="form.org_address_contact_name"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="organizationContactName"
                            />
                            <InputError :message="form.errors.org_address_contact_name" class="mt-2" />
                        </div>
                        <!-- Organization Contact Phone -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="organizationContactPhone" value="Organization Contact Phone" />
                            <TextInput
                                id="organizationContactPhone"
                                v-model="form.org_address_contact_phone"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="organizationContactPhone"
                            />
                            <InputError :message="form.errors.org_address_contact_phone" class="mt-2" />
                        </div>
                    </template>

                    <template #actions>
                        <ActionMessage :on="form.recentlySuccessful" class="me-3">
                            {{ props.organization?.id ? 'Updated.' : 'Created.' }}
                        </ActionMessage>
                        
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            {{ props.organization?.id ? 'Update' : 'Create' }}
                        </PrimaryButton>
                    </template>
                </FormSection>
            </div>
        </div>
    </AppLayout>
</template>