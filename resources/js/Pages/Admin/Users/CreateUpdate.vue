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
    user: Object
});

const form  = useForm({
    _method: props.user?.id ? 'PUT' : 'POST',
    name: props.user?.name ?? '',
    email: props.user?.email ?? '',
    password: '',
    password_confirmation: '',
});

const createNewUser = () => {
    const id = props.user?.id ?? null;

    if (id) {
        form.put(route('users.update', [id]), {
            preserveScroll: true,
        });
    } else {
        form.post(route('users.store'), {
            preserveScroll: true,
        });
    }
};


</script>

<template>
    <AppLayout title="Users">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Users
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <FormSection @submitted="createNewUser">
                    <template #title>
                        User Information
                    </template>
                    <template #description>
                        {{ props.user?.id ? 'This Section Updates A User' : 'This Section Creates A User'}}
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
                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="mt-1 block w-full"
                                required
                                autocomplete="email"
                            />
                            <InputError :message="form.errors.email" class="mt-2" />
                        </div>
                        <!-- Password -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="password" value="Password" />
                            <TextInput
                                id="password"
                                v-model="form.password"
                                type="password"
                                class="mt-1 block w-full"
                                required
                                autocomplete="password"
                            />
                            <InputError :message="form.errors.password" class="mt-2" />
                        </div>
                        <!-- Password Confirmation -->
                        <div class="col-span-6 sm:col-span-4">
                            <InputLabel for="passwordConfirmation" value="Confirm Password" />
                            <TextInput
                                id="passwordConfirmation"
                                v-model="form.password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                                required
                                autocomplete="new-password"
                            />
                            <InputError :message="form.errors.password_confirmation" class="mt-2" />
                        </div>
                    </template>

                    <template #actions>
                        <ActionMessage :on="form.recentlySuccessful" class="me-3">
                            {{ props.user?.id ? 'Updated.' : 'Created.' }}
                        </ActionMessage>
                    
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            {{ props.user?.id ? 'Update' : 'Create' }}
                        </PrimaryButton>
                    </template>
                </FormSection>
            </div>
        </div>
    </AppLayout>
</template>