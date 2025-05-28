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
    area: Object
});

const form  = useForm({
    _method: 'POST',
    name: props.user?.name,
    parentId: props.user?.parentId,
    latitude: props.user?.latitude,
    longitude: props.user?.longitude,
    
});

const createNewArea = () => {
    form.post(route('areas.store')), {
        preserveScroll: true,
    }
};


</script>

<template>
    <AppLayout>
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
                        </div>
                        <!-- ParentID -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="parentArea" value="Parent Area" />
                            <select name="" id=""></select>t
                            <TextInput
                                id="parentId"
                                v-model="form.parentId"
                                type="parentId"
                                class="mt-1 block w-full"
                                required
                                autocomplete="parentId"
                            />
                            <InputError :message="form.errors.parentId" class="mt-2" />
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