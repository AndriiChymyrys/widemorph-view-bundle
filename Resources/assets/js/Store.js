import {createStore} from 'vuex'

import CORE from './App/Store/Core/store';

export default createStore({
    modules: {
        'core': CORE,
    }
})
