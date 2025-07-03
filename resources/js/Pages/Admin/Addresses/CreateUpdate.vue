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
    areas : Array,
    address: Object
});

const form  = useForm({
    _method: props.address? 'PUT' : 'POST',
    type: props.address?.type ?? 'home',
    name: props.address?.name,
    street_address: props.address?.street_address,
    apartment_address: props.address?.apartment_address,
    area_id: props.address?.area_id ?? '',
    zip_code: props.address?.zip_code,
    latitude: props.address?.latitude,
    longitude: props.address?.longitude,
    is_primary: props.address?.is_primary ?? 1,
    contact_name: props.address?.contact_name,
    contact_phone: props.address?.contact_phone,
    addressable_id: props.address?.addressable_id,
    addressable_type: props.address?.addressable_type,
});

const createNewAddress = () => {
    const id = props.address?.id ?? null;
    if(id) {
        form.put(route('addresses.update', [id])), {
            preserveScroll: true,
        }
    } else {
        form.post(route('addresses.store')), {
            preserveScroll: true,
        }
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
                <FormSection @submitted="createNewAddress">
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
                            <!-- <TextInput
                                id="type"
                                v-model="form.type"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="type"
                            /> -->

                            <select class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                    id="type"
                                    required
                                    v-model="form.type"
                                    >
                                <option value="home">Home Address</option>
                                <option value="office">Office Address</option>
                            </select>
                            <InputError :message="form.errors.type" class="mt-2" />
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
                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>
                        <!-- Street Address -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="streetAddress" value="Street Address" />
                            <TextInput
                                id="streetAddress"
                                v-model="form.street_address"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="streetAddress"
                            />
                            <InputError :message="form.errors.street_address" class="mt-2" />
                        </div>
                        <!-- Apartment Address -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="apartmentAddress" value="Apartment Address" />
                            <TextInput
                                id="apartmentAddress"
                                v-model="form.apartment_address"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="apartmentAddress"
                            />
                            <InputError :message="form.errors.apartment_address" class="mt-2" />
                        </div>
                        <!-- Area ID -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="areaID" value="Area ID" />
                            <!-- <TextInput
                                id="areaID"
                                v-model="form.area_id"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="areaID"
                            /> -->
                            <select 
                                id="areaID"
                                v-model="form.area_id"
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
                            <InputError :message="form.errors.area_id" class="mt-2" />
                        </div>
                        <!-- Zip Code -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="zipCode" value="Zip Code" />
                            <TextInput
                                id="zipCode"
                                v-model="form.zip_code"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="zipCode"
                            />
                            <InputError :message="form.errors.zip_code" class="mt-2" />
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
                            <!-- <TextInput
                                id="isPrimary"
                                v-model="form.is_primary"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="isPrimary"
                            /> -->
                            <select class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                    id="isPrimary"
                                    required
                                    v-model="form.is_primary"
                                    >
                                <option value="1">Primary</option>
                                <option value="0">Non-Primary</option>
                            </select>
                            <InputError :message="form.errors.is_primary" class="mt-2" />
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
                        <!-- Address Type -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="addressableType" value="Address Type" />
                            <TextInput
                                id="addressableType"
                                v-model="form.addressable_type"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="addressableType"
                            />
                            <InputError :message="form.errors.addressable_type" class="mt-2" />
                        </div>
                        <!-- Address -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="addressableId" value="Address" />
                            <TextInput
                                id="addressableId"
                                v-model="form.addressable_id"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autocomplete="addressableId"
                            />
                            <InputError :message="form.errors.addressable_id" class="mt-2" />
                        </div>
                    </template>

                    <template #actions>
                        <ActionMessage :on="form.recentlySuccessful" class="me-3">
                            {{ props.address?.id ? 'Updated' : 'Created' }}
                        </ActionMessage>
                    
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            {{ props.address?.id ? 'Update' : 'Create' }}
                        </PrimaryButton>
                    </template>
                </FormSection>
            </div>
        </div>
    </AppLayout>
</template>