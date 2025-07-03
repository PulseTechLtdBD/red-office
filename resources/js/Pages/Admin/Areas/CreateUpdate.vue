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
    area: Object,
    areas: Array
});

const form  = useForm({
    _method: props.area?.id ? 'PUT' : 'POST',
    name: props.area?.name ?? '',
    parent_id: props.area?.parent_id ?? '',
    latitude: props.area?.latitude ?? '',
    longitude: props.area?.longitude ?? '',
    
});

const createNewArea = () => {
    const id = props.area?.id ?? null;
    if(id) {
        form.put(route('areas.update', [id])), {
            preserveScroll: true,
        }
    } else {
        form.post(route('areas.store')), {
            preserveScroll: true,
        }
    }
};


</script>

<template>
    <AppLayout title="Areas">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Areas
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <FormSection @submitted="createNewArea">
                    <template #title>
                        Area Information
                    </template>
                    <template #description>
                        This Section Creates New Area
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
                        <!-- Parent Area -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="parentArea" value="Parent Area" />
                            <select 
                                id="parentArea"
                                v-model="form.parent_id"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            >
                                <option value="" disabled>-- Select Parent Area --</option>
                                <option 
                                v-for="area in props.areas"
                                :key="area.id"
                                :value="area.id"
                            >
                                {{ area.name }}
                                </option>
                            </select>
                            <InputError :message="form.errors.parent_id" class="mt-2" />
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
                    </template>

                    <template #actions>
                        <ActionMessage :on="form.recentlySuccessful" class="me-3">
                            {{ props.area?.id ? 'Updated.' : 'Created.' }}
                        </ActionMessage>
                    
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            {{ props.area?.id ? 'Update' : 'Create' }}
                        </PrimaryButton>
                    </template>
                </FormSection>
            </div>
        </div>
    </AppLayout>
</template>