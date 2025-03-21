import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { useEffect } from 'react';

export default function Dashboard() {
    useEffect(() => {
        const channel = window.Echo.private('sync_local_data');

        channel.listen('.updated_data', (event: any) => {
            console.log({ UploadedData: event });
        });

        return () => {
            channel.unsubscribe();
        };
    }, []);
   
    // Public messages
    useEffect(() => {
        const channel = window.Echo.channel('sent-messages');

        channel.listen('.send-new', (event: any) => {
            console.log({ UploadedData: event });
        });

        return () => {
            channel.unsubscribe();
        };
    }, []);

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            You're logged in!
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
