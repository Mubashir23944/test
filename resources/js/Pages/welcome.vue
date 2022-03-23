<template>
    <h1>Welcome {{name}}</h1>

    <nav>
        <ul>
            <li><Link href="/users">Users</Link></li>
            <li><Link href="/bikes">Bikes</Link></li>
            <li><Link href="/cars">Cars</Link></li>
        </ul>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    components : { Link },
    props: {
        name: String,
    }
};
</script>
