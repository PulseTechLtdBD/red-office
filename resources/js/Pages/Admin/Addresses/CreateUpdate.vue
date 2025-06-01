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
    pageTitle: String,
    address: Object
});

const form  = useForm({
    _method: 'POST',
    type: props.address?.type,
    name: props.address?.name,
    street_address: props.address?.street_address,
    apartment_address: props.address?.apartment_address,
    area_id: props.address?.area_id,
    zip_code: props.address?.zip_code,
    latitude: props.address?.latitude,
    longitude: props.address?.longitude,
    is_primary: props.address?.is_primary,
    contact_name: props.address?.contact_name,
    contact_phone: props.address?.contact_phone,
    addressable_id: props.address?.addressable_id,
    addressable_type: props.address?.addressable_type,
});

const createNewUser = () => {
    form.post(route('addresses.store')), {
        preserveScroll: true,
    }
};


</script>

<template>
    <AppLayout title="Addresses">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Addresses
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <FormSection @submitted="createNewUser">
                    <template #title>
                        Address Information
                    </template>
                    <template #description>
                        This Section Creates New Address
                    </template>
                
                    <template #form>
                        <!---Type-->
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
                        </div>
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
                        <!-- Street Address -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="streetAddress" value="Street Address" />
                            <TextInput
                                id="streetAddress"
                                v-model="form.streetAddress"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="streetAddress"
                            />
                            <InputError :message="form.errors.streetAddress" class="mt-2" />
                        </div>
                        <!-- Apartment Address -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="apartmentAddress" value="Apartment Address" />
                            <TextInput
                                id="apartmentAddress"
                                v-model="form.apartmentAddress"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="apartmentAddress"
                            />
                            <InputError :message="form.errors.apartmentAddress" class="mt-2" />
                        </div>
                        <!-- Area ID -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="areaID" value="Area ID" />
                            <TextInput
                                id="areaID"
                                v-model="form.areaID"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="areaID"
                            />
                            <InputError :message="form.errors.areaID" class="mt-2" />
                        </div>
                        <!-- Zip Code -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="zipCode" value="Zip Code" />
                            <TextInput
                                id="zipCode"
                                v-model="form.zipCode"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="zipCode"
                            />
                            <InputError :message="form.errors.zipCode" class="mt-2" />
                        </div>
                        <!-- Latitude -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="latitude" value="Latitude" />
                            <TextInput
                                id="latitude"
                                v-model="form.latitude"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="latitude"
                            />
                            <InputError :message="form.errors.latitude" class="mt-2" />
                        </div>
                        <!-- Longitude -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="longitude" value="Longitude" />
                            <TextInput
                                id="longitude"
                                v-model="form.longitude"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="longitude"
                            />
                            <InputError :message="form.errors.longitude" class="mt-2" />
                        </div>
                        <!-- Is Primary -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="isPrimary" value="Is Primary" />
                            <TextInput
                                id="isPrimary"
                                v-model="form.isPrimary"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="isPrimary"
                            />
                            <InputError :message="form.errors.isPrimary" class="mt-2" />
                        </div>
                        <!-- Contact Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="contactName" value="Is Primary" />
                            <TextInput
                                id="isPrimary"
                                v-model="form.isPrimary"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="isPrimary"
                            />
                            <InputError :message="form.errors.isPrimary" class="mt-2" />
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
                            <InputError :message="form.errors.contactPhone" class="mt-2" />
                        </div>
                        <!-- Addressable ID -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="addressableId" value="Addressable ID" />
                            <TextInput
                                id="addressableId"
                                v-model="form.addressableId"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="addressableId"
                            />
                            <InputError :message="form.errors.addressableId" class="mt-2" />
                        </div>
                        <!-- Addressable Type -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="addressableType" value="Addressable Type" />
                            <TextInput
                                id="addressableType"
                                v-model="form.addressableType"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="addressableType"
                            />
                            <InputError :message="form.errors.addressableType" class="mt-2" />
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